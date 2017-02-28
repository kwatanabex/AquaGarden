<?php
/**
 * DBクラス
 */
SyL_Loader::lib('DB');
/**
 * DBデータアクセスクラス
 */
SyL_Loader::lib('DB.Dao');
SyL_Loader::lib('DB.Dao.Table');

SyL_Loader::lib('Util.PropertyOverload');
SyL_Loader::userLib('EuryL.Data.User');
SyL_Loader::userLib('EuryL.Data.Authority');
SyL_Loader::userLib('EuryL.Data.Application');


/**
 * AQUARIMマネージャクラス
 *
 * @package   SyL
 * @author    Koki Watanabe <k.watanabe@syl.jp>
 * @copyright 2006-2007 k.watanabe
 * @license   http://www.opensource.org/licenses/lgpl-license.php
 * @version   CVS: $Id:$
 * @link      http://www.syl.jp/
 */
class EuryLManager
{
    /**
     * DAOオブジェクト
     *
     * @access private
     * @var object
     */
    var $dao = null;
    /**
     * DAOクラス名
     *
     * @access protected
     * @var string
     */
    var $dao_classname = 'EuryL.Dao.Default';

    /**
     * コンストラクタ
     *
     * @access private
     * @param object DBオブジェクト
     */
    function EuryLManager()
    {
        static $dao = array();
        $classname = SyL_Loader::convertClass($this->dao_classname, true, '');
        if (!isset($dao[$classname])) {
            $dao[$classname] =& new $classname($this->getConnection());
        }
        $this->dao = $dao[$classname];
    }

    /**
     * マネージャクラスの生成
     *
     * @static
     * @access public
     * @param string マネージャ名
     * @param bool 強制再生成フラグ
     */
    function &getManager($name, $force=false)
    {
        static $managers = array();
        if (!isset($managers[$name]) || $force) {
            $classname = SyL_Loader::convertClass("EuryL.Manager.{$name}", true, '');
            $managers[$name] = new $classname();
        }
        return $managers[$name];
    }

    /**
     * データクラスの生成
     *
     * @static
     * @access public
     * @param string データ名
     * @return object データオブジェクト
     */
    function createData($name)
    {
        $name = ucfirst($name);
        $classname = SyL_Loader::convertClass("EuryL.Data.{$name}", true, '');
        return new $classname();
    }

    /**
     * テーブルクラスの生成
     *
     * @static
     * @access public
     * @param string テーブル名
     * @return object テーブルオブジェクト
     */
    function createTable($name)
    {
        $name = ucfirst($name);
        $classname = SyL_Loader::convertClass("EuryL.Table.{$name}", true, '');
        return new $classname();
    }

    /**
     * DBオブジェクトを取得する
     *
     * @access public
     * @return object DBオブジェクト
     */
    function &getConnection()
    {
        return SyL_DB::getConnection();
    }

    /**
     * 接続情報を取得する
     *
     * @access public
     * @return array 接続情報
     */
    function getDsnInfo()
    {
        $conn =& $this->dao->getConnection();
        $dsn = $conn->getDsnInfo();
        $dsn['driver'] = $conn->getType();
        return $dsn;
    }
}

?>
