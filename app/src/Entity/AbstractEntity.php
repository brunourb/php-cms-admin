<?php
/**
 * Created by IntelliJ IDEA.
 * User: bruno
 * Date: 04/03/18
 * Time: 21:35
 */

namespace App\Entity;


abstract class AbstractEntity {

    public function getAvoidedFields() {
        return array ();
    }

    public function toArray() {
        try{

            $temp = ( array ) $this;

            $array = array ();

            foreach ( $temp as $k => $v ) {
                $k = preg_match ( '/^\x00(?:.*?)\x00(.+)/', $k, $matches ) ? $matches [1] : $k;
                if (in_array ( $k, $this->getAvoidedFields () )) {
                    $array [$k] = "";
                } else {

                    // if it is an object recursive call
                    if (is_object ( $v ) && $v instanceof AbstractEntity) {
                        $array [$k] = $v->toArray();
                    }
                    // if its an array pass por each item
                    if (is_array ( $v )) {

                        foreach ( $v as $key => $value ) {
                            if (is_object ( $value ) && $value instanceof AbstractEntity) {
                                $arrayReturn [$key] = $value->toArray();
                            } else {
                                $arrayReturn [$key] = $value;
                            }
                        }
                        $array [$k] = $arrayReturn;
                    }
                    // if it is not a array and a object return it
                    if (! is_object ( $v ) && !is_array ( $v )) {
                        $array [$k] = $v;
                    }
                }
            }

            return $array;

        }catch (\Exception $e){
            throw new \Exception('Erro ao converter objeto para array'.$e->getMessage());
        }
    }
}