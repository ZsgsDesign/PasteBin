<?php
    class Core
    {
        public static function viewIndex()
        {
            $structure_header=file_get_contents(dirname(__FILE__)."/../view/structure_header.html");
            $core_index=file_get_contents(dirname(__FILE__)."/../view/core_index.html");
            $structure_footer=file_get_contents(dirname(__FILE__)."/../view/structure_footer.html");
            echo $structure_header;
            echo $core_index;
            echo $structure_footer;
        }
    }

    $core=new Core();

