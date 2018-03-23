<?php
    Class Registro {
        private $id;
        private $idHorario;
        private $data;
        
        public function Registro() {
            
        }
        
        public function getId(){ return $this->id; }
        public function setId($id){ $this->id = $id; }
        public function getIdHorario(){ return $this->idHorario; }
        public function setIdHorario($idHorario){ $this->idHorario = $idHorario; }
        public function getData(){ return $this->data; }
        public function setData($data){ $this->data = $data; }
    }
?>