<?php
class Size {
    public int $id = 0;
    public string $name = "";
    public string $description = "";
    public string $creating_date = "";

    function __construct($id, $name, $description, $creating_date) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->creating_date = $creating_date;
    }

    public function getId () : int {
        return $this->id;
    }
    public function getName (): string {
        return $this->name;
    }
    public function getDescription () : string {
        return $this->description;
    }
    public function getCreatingDate () : string {
        return $this->creating_date;
    }
}