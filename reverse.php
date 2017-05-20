<?php

error_reporting(0);
function reverse_IP($remoteHost)
	{
	$IP = gethostbyname($remoteHost);
	if (empty($IP))
		{
		echo 'Invalid domain.';
		}
	  else
		{
		for ($f = 0; $f <= 80; $f+= 10)
			{
			$url = 'http://www.bing.com/search?format=rss&q=IP%3A' . $IP . '&go=Submit&First=' . $f;
			$xml = simplexml_load_file($url);
			$nodes = $xml->channel->item[0]->link;
			foreach($nodes as $node)
				{
				for ($i = 0; $i <= 9; $i++)
					{
					$fullURL[] = $xml->channel->item[$i]->link;
					}
				}

			$cntURL = count($fullURL);
			for ($y = 0; $y < $cntURL; $y++)
				{
				$result = $fullURL[$y];
				$TLD[] = parse_url(str_replace('www.', '', $result[0]) , PHP_URL_HOST);
				}
			}

		if (empty($TLD))
			{
			echo "Can't find IP from this domain.";
			}
		  else
			{
			$rev_result = array_unique($TLD);
			print("
			
__________  ___ _____________  __________                                         ._____________ 
\______   \/   |   \______   \ \______   \ _______  __ ___________  ______ ____   |   \______   \
 |     ___/    ~    \     ___/  |       _// __ \  \/ // __ \_  __ \/  ___// __ \  |   ||     ___/
 |    |   \    Y    /    |      |    |   \  ___/\   /\  ___/|  | \/\___ \\  ___/  |   ||    |    
 |____|    \___|_  /|____|      |____|_  /\___  >\_/  \___  >__|  /____  >\___  > |___||____|    
                 \/                    \/     \/          \/           \/     \/   			 
===================================================================================================
                                    ");
			print("Reversed IP: ".$IP);
			print("
===================================================================================================			
			\n");
			for ($x = 0; $x <= 500; $x++)
				{
				if (!empty($rev_result[$x]))
					{
					print "[+] " . $rev_result[$x] . "\n";
					}
				}
			}
		}
	}
	
$ip = $argv[2];
if(!empty($ip))
{
	reverse_IP($ip);
}
