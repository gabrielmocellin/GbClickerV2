<?php
    interface IDAO{
        public function insert($model);
        public function select();
        public function update($model);
        public function delete($identifier);
    }