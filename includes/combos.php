<?php
    class combos
    {
        public static function CombosSelect($permiso, $id, $select, $from, $elId, $ElNombre, $busco)
        {
             $res_ = paraTodos::arrayConsulta($select, $from, $busco);
            foreach ($res_ as $row) {
                echo "<option value=\"$row[$elId]\"";
                if ($row["$elId"] == $id) {
                    echo 'selected';
                }
                echo ">$row[$ElNombre]</option>\n";
            }
        }
    }
