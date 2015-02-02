<?php

class Tables {

    public $name;
    private $fields;
    private $selected_tables;

    public function __construct( $pname ) {
        $this->name = $pname;
    }

	public function set_fields( $pfields) {
	    $this->fields = $pfields;
	}

	public function get_fields() {
	    return $this->fields;
	}

}

?>
