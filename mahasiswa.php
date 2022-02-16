<?php
 
 echo "Masukan (NIM/Nama Mahasiswa) : ";
 $type;
 $in = fopen("php://stdin","r");
 $d = trim(fgets($in));

 $url = "https://api-frontend.kemdikbud.go.id/hit_mhs/".$d;

 $curl = curl_init($url);
 curl_setopt($curl, CURLOPT_URL, $url);
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
 
 $headers = array(
    "Accept: application/json",
 );
 curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
 curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
 
 $res = curl_exec($curl);
 curl_close($curl);

 echo "============================\n";
 echo " \e[1;36;42m(NIM/Nama Mahasiswa)\e[0m : ".$d."\n";
 echo "============================\n";
 $dataRes = json_decode($res, true);

if(is_null($dataRes)) { 
    echo "================================================\n";
    echo "  Null\n";
    echo "================================================\n";
} else if(empty($dataRes["text"])) {
    echo "================================================\n";
    echo "  Empty\n";
    echo "================================================\n";
} else {
    $answer = [];
    foreach($dataRes['mahasiswa'] as $key => $value) {
        $answer[$key]['text'] = $value['text'];
        $answer[$key]['website-link'] = $value['website-link'];
    }
    
    foreach($answer as $key=>$node) {
        $values = $node["website-link"];
        $key = explode('/', $values);

        echo "Nama : ".$node["text"]."\n========================\nURL : https://api-frontend.kemdikbud.go.id/detail_mhs/".$key[2]."\n========================\n";
    }
}


?>