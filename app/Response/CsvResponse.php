<?php

namespace App\Response;

use App\Response\ResponseStructure;


class CsvResponse implements ResponseStructure
{
    public $string;

    public function output($data, $status)
    {
        if (is_array($data)&& !empty($data)) {
            foreach ($data as $row) {
                $this->string .= "\r\n";
                $this->string .= implode(",", $row);
            }
            echo $this->string;
        }else{

            echo "No Records found";
        }

        
    }
}
