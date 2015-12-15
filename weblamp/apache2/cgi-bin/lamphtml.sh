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
	echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title></title></head></html>'
	cgi_getvars BOTH ALL
	VERBOSE=$(if [ $VERBOSE = "true" ] ; then echo '-v' ; fi)
	SHOW_SLEEP_TIME=$(if [ $SHOW_SLEEP_TIME = "true" ] ; then echo '-t' ; fi)
	MORSE=$(if [ $MORSE = "true" ] ; then echo '-m' ; fi)
		if [ "$MODE" != "" ]
			then
				case $MODE in
					"morse")
						echo "" > output
						{ echo '<p>'; /usr/local/bin/lampctl $VERBOSE $SHOW_SLEEP_TIME $MORSE morse "$PIN" "$BASE_TIME" "$MESSAGE"; } >> output &
					;;
					"simple")
						echo "" > output
						{ echo '<p>'; /usr/local/bin/lampctl $VERBOSE $SHOW_SLEEP_TIME $MORSE simple "$PIN" "$ON_TIME" "$OFF_TIME" "$CYCLES"; } >> output &
					;;
					"ramp")
						echo "" > output
						{ echo '<p>'; /usr/local/bin/lampctl $VERBOSE $SHOW_SLEEP_TIME $MORSE ramp "$PIN" "$START_ON_TIME" "$START_OFF_TIME" "$END_ON_TIME" "$END_OFF_TIME" "$CYCLES"; } >> output &
					;;
					"setup")
						echo "" > output
						{ echo '<p>'; /usr/local/bin/lampctl $VERBOSE $SHOW_SLEEP_TIME $MORSE setup "$PIN"; } >> output &
					;;
					"on") 
						echo "" > output
						{ echo '<p>'; /usr/local/bin/lampctl $VERBOSE $SHOW_SLEEP_TIME $MORSE on "$PIN"; } >> output &
					;;
					"off")
						echo "" > output
						{ echo '<p>'; /usr/local/bin/lampctl $VERBOSE $SHOW_SLEEP_TIME $MORSE off "$PIN"; } >> output &
					;;
					"toggle")
						echo "" > output
						{ echo '<p>'; /usr/local/bin/lampctl $VERBOSE $SHOW_SLEEP_TIME $MORSE toggle "$PIN"; } >> output &
						;;				
				esac
		fi
	exit 0
}
html
