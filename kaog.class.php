<?php


/**
 * 資料
 */

namespace MTsung {

    class kaog extends center
    {

        function __construct($console, $table, $lang = LANG)
        {
            parent::__construct($console, $table, $lang);
            // $this->checkTable();
            $this->tempLockSort = false;
        }

        /**
         * 檢查資料表是否存在 不存在就建立
         * @return [type] [description]
         */
        function checkTable()
        {
            if (!$this->isTable($this->table)) {
                $this->conn->Execute("
					CREATE TABLE `".$this->table."` (
					  `id` int(11) NOT NULL AUTO_INCREMENT,
					  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '創建時間',
					  `update_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '最後修改時間',
					  `create_user` varchar(191) NOT NULL COMMENT '創建人',
					  `update_user` varchar(191) NOT NULL COMMENT '最後修改人',
					  PRIMARY KEY (`id`)
					) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;
				");
            }
        }
    }
}
