<?php
class Seller {
    public int $id = 0;
    public string $first_name = "";
    public string $last_name = "";
    public string $epost = "";
    public string $mobile = "";
    public string $creating_date = "";

    function __construct($id, $first_name, $last_name, $epost, $mobile, $creating_date) {
        $this->id = $id;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->epost = $epost;
        $this->mobile = $mobile;
        $this->creating_date = $creating_date;
    }

    // public function getId () : int {
    //     return $this->id;
    // }
    // public function getFirstName (): string {
    //     return $this->first_name;
    // }
    // public function getLastName (): string {
    //     return $this->last_name;
    // }
    // public function getEpost () : string {
    //     return $this->epost;
    // }
    // public function getMobile () : string {
    //     return $this->mobile;
    // }
    // public function getCreatingDate () : string {
    //     return $this->creating_date;
    // }
}