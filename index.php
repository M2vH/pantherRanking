<?php  


    $u13 = 'id_20';
    
    $url = 'https://www.afcvnrw.de/cms/verband/spielbetrieb/liga-tabellenaspiele.html';

        //$userAgent = 'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.2) Gecko/20090729 Firefox/3.5.2 GTB5';
        $ch = curl_init();
      //  curl_setopt($ch,CURLOPT_COOKIE,"someCookie=2127;onlineSelection=C");
      //  curl_setopt ($ch, CURLOPT_COOKIEFILE, 'cookie.txt');
      //  curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookie.txt');
      //  curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
        curl_setopt($ch, CURLOPT_URL, $url);
     //   curl_setopt($ch, CURLOPT_FAILONERROR, true);
    //    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
 //    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1000);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $html = curl_exec($ch);
        curl_close($ch);

        $doc = new DOMDocument;
        $doc->validateOnParse = true;
        $doc->strictErrorChecking = false;
        $doc->formatOutput = true;
        
        // ToDo: replace string to validate xml.
        $validhtml = str_replace('</tr align=center>' , '</tr>' , $html);
        

        // Encoding the html
        // $encoded = htmlspecialchars($inkldus);
        // $encoded = htmlentities($inkldus);
        $encoded = $validhtml;
        // $encoded = $inkldus;

        @$doc->loadHTML( $encoded );
        // @$doc->loadHTML( $encoded );
        // echo $doc->saveHTML($doc->getElementById('id_19'));

        // Get the Liga-Element with id='id_19'
        // $liga = $doc->getElementByID('id_19')->nodeValue;
        // $mylayout = new DOMDocument;
        
        $liga = $doc->getElementByID($u13)->childNodes;
        
        // Works
        // $innerHTML = '';
        
        // foreach($liga as $info){
        //   $innerHTML .= $info->ownerDocument->saveHTML($info);
        // }
        

        // Works: create Arrays of replacements
        $search = array('D?sseldorf','M?nchengladbach');
        $replace = array('Düsseldorf','Mönchengladbach');
        
        // Works
        // $inkldus = str_replace($search, $replace, $innerHTML);
        
        // Works:
        // echo $inkldus;
        
        $tabelleHead = $liga[0];
        $tabelle = $liga[2];
        //var_dump($tabelle);
        
        // $tabelle = str_replace($search, $replace, $tabelle);

        $printHEAD = $tabelleHead->ownerDocument->saveHTML($tabelleHead);
        $printHTML = $tabelle->ownerDocument->saveHTML($tabelle);

        $printTABLE = str_replace($search, $replace, $printHTML);

        echo $printHEAD;
        echo $printTABLE;
        // ToDo: Create bootstrap layout
    ?>

