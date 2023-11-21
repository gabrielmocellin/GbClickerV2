<?php
    class LevelModel{
        public $level, $xp_points, $max_to_up;

        public function __construct(string $FK_user_email){
            $this->getLevelData($FK_user_email);
        }

        private function getLevelData(string $FK_user_email){
            $dao = new LevelDAO();

            $dao_result_array = $dao->selectByEmail($FK_user_email);

            $this->level     = $dao_result_array['level'];
            $this->xp_points = $dao_result_array['xp_points'];
            $this->max_to_up = $dao_result_array['max_to_up'];
        }
    }
?>