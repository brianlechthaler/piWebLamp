<?php

namespace Lamp;

use Lamp\WebSocket\ClientRepository;
use PhpGpio\Gpio;
use Lamp\Lamp\Lamp;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Server implements MessageComponentInterface
{
    /**
     * The chat repository
     *
   function connectSocket($socket, $address){
		if(false === socket_connect($socket, $address)){
			echo "Could not connect socket " .$socket." to ".$address.": \nReason:	".socket_strerror(socket_last_error($socket))."\n";
			return false;
//			die;
		} else {
			echo "Connected socket " .$socket." to ".$address."\n";
			return true;
		}
	}  * @var ChatRepository
     */
    public $repository;
    protected $loop;
    protected $status;
    protected $pin_list;
    protected $Gpio;
	
    /**
     * Chat Constructor
     */
    public function __construct($loop)
    {
        $this->repository = new ClientRepository();
        $this->status = array
			(
				'pin_2' =>array('None','N/A'),
				'pin_3' =>array('None','N/A'),
				'pin_4' =>array('None','N/A'),
				'pin_7' =>array('None','N/A'),
				'pin_8' =>array('None','N/A'),
				'pin_9' =>array('None','N/A'),
				'pin_10'=>array('None','N/A'),
				'pin_11'=>array('None','N/A'),
				'pin_14'=>array('None','N/A'),
				'pin_15'=>array('None','N/A'),
				'pin_17'=>array('None','N/A'),
				'pin_18'=>array('None','N/A'),
				'pin_22'=>array('None','N/A'),
				'pin_23'=>array('None','N/A'),
				'pin_24'=>array('None','N/A'),
				'pin_25'=>array('None','N/A'),
				'pin_27'=>array('None','N/A')
			);
		$this->pin_list = array(2, 3, 4, 7, 8, 9, 10, 11, 14, 15, 17, 18, 22, 23, 24, 25, 27);
		$this->Gpio = new Gpio;
		$this->loop = $loop;
    }

    /**
     * Called when a connection is opened
     *
     * @param ConnectionInterface $conn
     * @return void
     */
    public function onOpen(ConnectionInterface $conn)
    {
        $client = $this->repository->addClient($conn);
		echo "Client ".$client->getName()." connected \n";
        $this->readStatus();
    }

    /**
     * Called when a message is sent through the socket
     *
     * @param ConnectionInterface $conn
     * @param string              $msg
     * @return void
     */
    public function onMessage(ConnectionInterface $conn, $data){
		$loop = $this->loop;
		$lamp_process  = new \React\ChildProcess\Process('php lamp_process.php');
		$lamp_process->on('exit', function($output) use ($loop) {
			$loop->stop();
		});
		$lamp_process->start($loop);
		$lamp_process->stdout->on('data', function($output) {
			foreach ($this->repository->getClients() as $client){
				$client->send($output);
			}
		});
		$lamp_process->stdin->write($data);
	}
//		exit();
	 public function onClose(ConnectionInterface $conn){
        // The connection is closed, remove it, as we can no longer send it messages
        $client = $this->repository->getClientByConnection($conn);
        echo "Client ".$client->getName()." disconnected\n";
        $this->repository->removeClient($conn);
	}
    /**
     * Called when an error occurs on a connection
     *
     * @param ConnectionInterface $conn
     * @param Exception           $e
     * @return void
     */
    public function onError(ConnectionInterface $conn, \Exception $e){
        echo "The following error occured: ".$e->getMessage();

        $client = $this->repository->getClientByConnection($conn);

        // We want to fully close the connection
        if ($client !== null)
        {
            $client->getConnection()->close();
            $this->repository->removeClient($conn);
        }
    }
    private function readStatus(){
		/*foreach ($pin_list as $pin) {
			$this->status['pin_'.$pin] = array();
			if($Gpio->isExported($pin)) {
				$this->status['pin_'.$pin]['1'] = $Gpio->currentDirection($pin);
				$this->status['pin_'.$pin]['2'] = $Gpio->input($pin);
			} else {
				$this->status['pin_'.$pin]['1'] = 'None';
				$this->status['pin_'.$pin]['2'] = 'N/A';
			}
		}
		*/
		$updateData = array();
		$updateData['pin_status'] = $this->status;
		$updateData['function']='pin_update';
		$updateData['mode']='update';
		foreach ($this->repository->getClients() as $client){
                $client->send(json_encode($updateData, true));
		}
	}
}
