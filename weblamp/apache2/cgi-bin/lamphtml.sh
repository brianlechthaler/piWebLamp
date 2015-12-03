#!/bin/bash

function cgi_get_POST_vars()
{
    # check content type
    # FIXME: not sure if we could handle uploads with this..
    [ "${CONTENT_TYPE}" != "application/x-www-form-urlencoded" ] && \
	echo "Warning: you should probably use MIME type "\
	     "application/x-www-form-urlencoded!" 1>&2
    # save POST variables (only first time this is called)
    [ -z "$QUERY_STRING_POST" \
      -a "$REQUEST_METHOD" = "POST" -a ! -z "$CONTENT_LENGTH" ] && \
	read -n $CONTENT_LENGTH QUERY_STRING_POST
    return
}

# (internal) routine to decode urlencoded strings
function cgi_decodevar()
{
    [ $# -ne 1 ] && return
    local v t h
    # replace all + with whitespace and append %%
    t="${1//+/ }%%"
    while [ ${#t} -gt 0 -a "${t}" != "%" ]; do
	v="${v}${t%%\%*}" # digest up to the first %
	t="${t#*%}"       # remove digested part
	# decode if there is anything to decode and if not at end of string
	if [ ${#t} -gt 0 -a "${t}" != "%" ]; then
	    h=${t:0:2} # save first two chars
	    t="${t:2}" # remove these
	    v="${v}"`echo -e \\\\x${h}` # convert hex to special char
	fi
    done
    # return decoded string
    echo "${v}"
    return
}

# routine to get variables from http requests
# usage: cgi_getvars method varname1 [.. varnameN]
# method is either GET or POST or BOTH
# the magic varible name ALL gets everything
function cgi_getvars()
{
    [ $# -lt 2 ] && return
    local q p k v s
    # get query
    case $1 in
	GET)
	    [ ! -z "${QUERY_STRING}" ] && q="${QUERY_STRING}&"
	    ;;
	POST)form
	    cgi_get_POST_vars
	    [ ! -z "${QUERY_STRING_POST}" ] && q="${QUERY_STRING_POST}&"
	    ;;
	BOTH)
	    [ ! -z "${QUERY_STRING}" ] && q="${QUERY_STRING}&"
	    cgi_get_POST_vars
	    [ ! -z "${QUERY_STRING_POST}" ] && q="${q}${QUERY_STRING_POST}&"
	    ;;
    esac
    shift
    s=" $* "
    # parse the query data
    while [ ! -z "$q" ]; do
	p="${q%%&*}"  # get first part of query string
	k="${p%%=*}"  # get the key (variable name) from it
	v="${p#*=}"   # get the value from it
	q="${q#$p&*}" # strip first part from query string
	# decode and evaluate var if requested
	[ "$1" = "ALL" -o "${s/ $k /}" != "$s" ] && \
	    eval "$k=\"`cgi_decodevar \"$v\"`\""
    done
    return
}
function html ()
	{
	cgi_getvars GET ALL
	echo "Content-type: text/html"
	echo ""
	
	echo '<html>'
	echo '<head>'
	echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">'
	echo '<title>Lamp Control</title>'
	echo '</head>'
	echo '<body>'
		echo "Lamp Control"
		echo '<br>'
		echo '<br>'
		echo "<form method=GET action=\"${SCRIPT}\" id=\"mode_select\">"\
			"<input type=\"radio\" name=\"MODE\" value=\"morse\" onclick=\"document.getElementById('mode_select').submit();\" $( if [ "$MODE" = "morse" ] ; then echo 'checked' ; fi )> Morse<br>"\
			"<input type=\"radio\" name=\"MODE\" value=\"simple\" onclick=\"document.getElementById('mode_select').submit();\" $( if [ "$MODE" = "simple" ] ; then echo 'checked' ; fi )> Simple On Off<br>"\
			"<input type=\"radio\" name=\"MODE\" value=\"ramp\" onclick=\"document.getElementById('mode_select').submit();\" $( if [ "$MODE" = "ramp" ] ; then echo 'checked' ; fi )> Ramp On Off<br>"\
			"<input type=\"radio\" name=\"MODE\" value=\"setup\" onclick=\"document.getElementById('mode_select').submit();\" $( if [ "$MODE" = "setup" ] ; then echo 'checked' ; fi )> Setup<br>"\
			"<input type=\"radio\" name=\"MODE\" value=\"on\" onclick=\"document.getElementById('mode_select').submit();\" $( if [ "$MODE" = "on" ] ; then echo 'checked' ; fi )> On<br>"\
			"<input type=\"radio\" name=\"MODE\" value=\"off\" onclick=\"document.getElementById('mode_select').submit();\" $( if [ "$MODE" = "off" ] ; then echo 'checked' ; fi )> Off<br>"\
			"<input type=\"radio\" name=\"MODE\" value=\"toggle\" onclick=\"document.getElementById('mode_select').submit();\" $( if [ "$MODE" = "toggle" ] ; then echo 'checked' ; fi )> Toggle"
		echo '</form>'
		
		echo "<form method=GET action=\"${SCRIPT}\" id=\"flags\">" \
			"<input type=\"hidden\"   name=\"MODE\" value=\"$MODE\">"\
			"<input type=\"checkbox\" name=\"VERBOSE\" value=\"-v\" onclick=\"document.getElementById('flags').submit();\" $( if [ "$VERBOSE" = "-v" ] ; then echo 'checked' ; fi )> Verbose<br>"\
			"<input type=\"checkbox\" name=\"MORSE\" value=\"-m\" onclick=\"document.getElementById('flags').submit();\" $( if [ "$MORSE" = "-m" ] ; then echo 'checked' ; fi )> Morse Output<br>"\
			"<input type=\"checkbox\" name=\"SHOW_SLEEP_TIME\" value=\"-t\" onclick=\"document.getElementById('flags').submit();\" $( if [ "$SHOW_SLEEP_TIME" = "-t" ] ; then echo 'checked' ; fi )> Show Sleep Times <br>"
		echo "</form>"
		echo '<br>'
		if [ "$MODE" != "" ]
			then
				echo '<br>'
				case $MODE in
					"morse")
						echo "<form method=POST action=\"${SCRIPT}\" id=\"morse\">"
						echo '<table nowrap>'\
								'<tr><td>Pin</TD><TD><input type="text" name="PIN" size=12></td></tr>'\
								'<tr><td>Base Time Unit</TD><TD><input type="text" name="BASE_TIME" size=12></td></tr>'\
								'<tr><td>Message</TD><TD><input type="text" name="MESSAGE" size=12></td></tr>'\
								'</tr></table>'
						echo '<br><input type="submit" value="Execute">'
						echo '</form>'
						cgi_getvars POST ALL
						/usr/local/bin/lampctl $VERBOSE $SHOW_SLEEP_TIME $MORSE morse "$PIN" "$BASE_TIME" "$MESSAGE" > /usr/lib/cgi-bin/iframe.txt &
					;;
					"simple")
						echo "<form method=POST action=\"${SCRIPT}\" id=\"simple\">"
						echo '<table nowrap>'\
								'<tr><td>Pin</TD><TD><input type="text" name="PIN" size=12></td></tr>'\
								'<tr><td>On Time</TD><TD><input type="text" name="ON_TIME" size=12></td></tr>'\
								'<tr><td>Off Time</TD><TD><input type="text" name="OFF_TIME" size=12></td></tr>'\
								'<tr><td>Cycles</TD><TD><input type="text" name="CYCLES" size=12></td></tr>'\
								'</tr></table>'
						echo '<br><input type="submit" value="Execute">'
						echo '</form>'
						cgi_getvars POST ALL
						/usr/local/bin/lampctl $VERBOSE $SHOW_SLEEP_TIME $MORSE simple "$PIN" "$ON_TIME" "$OFF_TIME" "$CYCLES" >> /usr/lib/cgi-bin/iframe.html &
						echo "<br>"
					;;
					"ramp")
						echo "<form method=POST action=\"${SCRIPT}\" id=\"ramp\">"
						echo '<table nowrap>'\
								'<tr><td>Pin</TD><TD><input type="text" name="PIN" size=12></td></tr>'\
								'<tr><td>Starting On Time</TD><TD><input type="text" name="START_ON_TIME" size=12></td></tr>'\
								'<tr><td>Starting Off Time</TD><TD><input type="text" name="START_OFF_TIME" size=12></td></tr>'\
								'<tr><td>Ending On Time</TD><TD><input type="text" name="END_ON_TIME" size=12></td></tr>'\
								'<tr><td>Ending Off Time</TD><TD><input type="text" name="END_OFF_TIME" size=12></td></tr>'\
								'<tr><td>Cycles</TD><TD><input type="text" name="CYCLES" size=12></td></tr>'\
								'</tr></table>'
						echo '<br><input type="submit" value="Execute">'
						echo '</form>'
						cgi_getvars POST ALL
						/usr/local/bin/lampctl $VERBOSE $SHOW_SLEEP_TIME $MORSE ramp "$PIN" "$START_ON_TIME" "$START_OFF_TIME" "$END_ON_TIME" "$END_OFF_TIME" "$CYCLES" >> /usr/lib/cgi-bin/iframe.html &
					;;
					"setup")
						echo "<form method=POST action=\"${SCRIPT}\" id=\"setup\">"
						echo '<table nowrap>'\
								'<tr><td>Pin</TD><TD><input type="text" name="PIN" size=12></td></tr>'\
								'</tr></table>'
						echo '<br><input type="submit" value="Execute">'
						echo '</form>'
						cgi_getvars POST ALL
						/usr/local/bin/lampctl $VERBOSE $SHOW_SLEEP_TIME $MORSE setup "$PIN" >> /usr/lib/cgi-bin/iframe.html &
					;;
					"on")
						echo "<form method=POST action=\"${SCRIPT}\" id=\"on\">"
						echo '<table nowrap>'\
								'<tr><td>Pin</TD><TD><input type="text" name="PIN" size=12></td></tr>'\
								'</tr></table>'
						echo '<br><input type="submit" value="Execute">'
						echo '</form>'
						cgi_getvars POST ALL
						/usr/local/bin/lampctl $VERBOSE $SHOW_SLEEP_TIME $MORSE on "$PIN" >> /usr/lib/cgi-bin/iframe.html &
					;;
					"off")
						echo "<form method=POST action=\"${SCRIPT}\" id=\"off\">"
						echo '<table nowrap>'\
								'<tr><td>Pin</TD><TD><input type="text" name="PIN" size=12></td></tr>'\
								'</tr></table>'
						echo '<br><input type="submit" value="Execute">'
						echo '</form>'
						cgi_getvars POST ALL
						/usr/local/bin/lampctl $VERBOSE $SHOW_SLEEP_TIME $MORSE off "$PIN" >> /usr/lib/cgi-bin/iframe.txt &
					;;
					"toggle")
						echo "<form method=POST action=\"${SCRIPT}\" id=\"off\">"
						echo '<table nowrap>'\
								'<tr><td>Pin</TD><TD><input type="text" name="PIN" size=12></td></tr>'\
								'</tr></table>'
						echo '<br><input type="submit" value="Execute">'
						echo '</form>'
						cgi_getvars POST ALL
						/usr/local/bin/lampctl $VERBOSE $SHOW_SLEEP_TIME $MORSE toggle "$PIN" >> /usr/lib/cgi-bin/iframe.txt &
						;;				
				esac
		fi
	echo  "<pre>"
	gpio readall 
	echo "</pre>"
	echo  "<pre>"
	cat /usr/lib/cgi-bin/iframe.txt 
	echo "</pre>"
	echo '</body>'
	echo '</html>'
	
	exit 0
}
html
