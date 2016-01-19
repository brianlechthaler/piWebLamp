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
     * @var ChatRepository
     */
    protected $repository;
    protected $status;
    protected $pin_list;
    protected $Gpio;

    /**
     * Chat Constructor
     */
    public function __construct()
    {
        $this->repository = new ClientRepository;
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
    }

    /**
     * Called when a connection is opened
     *
     * @param ConnectionInterface $conn
     * @return void
     */
    public function onOpen(ConnectionInterface $conn)
    {
        $this->repository->addClient($conn);
    }

    /**
     * Called when a message is sent through the socket
     *
     * @param ConnectionInterface $conn
     * @param string              $msg
     * @return void
     */
    public function onMessage(ConnectionInterface $conn, $data)
    {
        // Parse the json
        $decodedData = json_decode($data, true);
        $operation = $decodedData['mode'];
		$Lamp = new Lamp;
		$Lamp->morse = (boolean) $decodedData['morse'];
		$Lamp->show_sleep_time = (boolean) $decodedData['show_sleep_time'];
		$Lamp->verbose = (boolean) $decodedData['verbose'];
		$this->readStatus();
		switch ($operation) {
			case "morse":
				$Lamp->morse($decodedData['pin'],$decodedData['base_time_unit'],$decodedData['message']);
				break;
			case "simple":
				$Lamp->simple($decodedData['pin'],$decodedData['on_time'],$decodedData['off_time'],$decodedData['cycles']);
				break;
			case "ramp":
				$Lamp->ramp($decodedData['pin'],$decodedData['start_on_time'],$decodedData['start_off_time'],$decodedData['end_on_time'],$decodedData['end_off_time'],$decodedData['cycles']);
				break;
			case "setup":
				$Lamp->setup($decodedData['pin']);
				break;
			case "on":
				$Lamp->on($decodedData['pin']);
				break;
			case "off":
				$Lamp->off($decodedData['pin']);
				break;
			case "toggle":
				$Lamp->toggle($decodedData['pin']);
				break;
			default:
				break;
		}
        $currClient = $this->repository->getClientByConnection($conn);

        // Distinguish between the actions
        foreach ($this->repository->getClients() as $client){
                // Send the message to the clients if, except for the client who sent the message originally
                if ($currClient->getName() !== $client->getName())
                    $client->sendMsg($currClient->getName(), $data->msg);
		}
    }

 

    /**
     * Called when a connection is closed
     *
     * @param ConnectionInterface $conn
     * @return void
     */
    public function onClose(ConnectionInterface $conn)
    {
        $this->repository->removeClient($conn);
    }

    /**
     * Called when an error occurs on a connection
     *
     * @param ConnectionInterface $conn
     * @param Exception           $e
     * @return void
     */
    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "The following error occured: " . $e->getMessage();

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
			$updateData['function']='status';
			$updateData['mode']='update';
			foreach ($this->repository->getClients() as $client){
	                // Send the message to the clients if, except for the client who sent the message originally
	                $client->sendMsg("server", json_encode($updateData));
			}
	}
}
