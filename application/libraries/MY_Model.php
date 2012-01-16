<?php 

if (! defined('BASEPATH')) exit('No direct script access');

/**
 * az osztaly a CI beepitett Model-jet terjeszti ki. Celja, hogy az egyes sajat modelekben ismetlodo metodusokat kiemeljuk.
 * sajat model osztalyinkat ebbol az osztalybol szarmaztassuk
 * hasznalatakor sajat osztalyaink konstruktoraban a $_name attributomot kell beallitani a megfelelo tablanevre.
 * 
 * @author Dobi Attila
 */
 
require_once(BASEPATH.'core/Model'.EXT);
class My_Model extends CI_Model 
{

	protected $_name;
	protected $_primary;

	//php 5 constructor
	public function __construct() 
	{
	    
	    if (empty($this->_name) || empty($this->_primary)) {
	        
	    //    throw new Exception('The name of the table and the primary key must be set');
	    }
	    
		parent::__construct();
	}
	
	/**
	 * visszaadja a tabla nevet
	 *
	 * @return string
	 * @author Dobi Attila
	 */
	public function getName()
	{
	    return $this->_quote($this->_name);
	}
	
	/**
	 * tabla osszes sorat adja vissza
	 *
     * @param array $params a kovetkezo kulcsokkal rendelkezhet: columns, join, order, limit, offset
	 * @return void
	 * @author Dobi Attila
	 */
	public function fetchAll($params = array(), $current = false, $showSelfColumns = true) 
	{
		
		$db = $this->db;
		
		/**
		 * osszepakoljuk a $params['columns']-ban kapott oszlopokbol az oszlopok listajat
		 *
		 * @author Dobi Attila
		 */
		if ($showSelfColumns) {
		    
		    $cols = "$this->_name.*";
		} else {
		    
		    $cols = "";
		}
		if (array_key_exists('columns', $params)) {
		    
			if ($cols) {
				$cols .= ', ';
			}
			
		    $cols .= join(', ', $params['columns']);
		    
		}
		
		/**
		 * osszepakoljuk a $params['join']['columns']-ban kapott oszlopokbol a kapcsolt tabla oszlopaibol a listat
		 *
		 * @author Dobi Attila
		 */
		if (array_key_exists('join', $params)) {
		    
            $c = array();
    	    foreach ($params['join'] as $j) {
    	        
    	        if (array_key_exists('columns', $j)) {
    	            
    	            $c[] = join(', ', $j['columns']);    
    	        }
    	    }
    	    
    	    if (!empty($c)) {
    	        
    		    $cols .= ', ' . implode(',', $c);
    	    }
		}
		
		$query = $db->select($cols)->from($this->_name);
		
		/**
         * join osszerakasa. $params['join'] kulcsai: tabla, condition
		 *
		 * @author Dobi Attila
		 */
		if (array_key_exists('join', $params)) {
		    
		    foreach ($params['join'] as $j) {
		        
		        $query->join($j['table'], $j['condition'], 'left');
		    }    	    		
		}
		
		/*
		    TODO ha tobb minden szerint akarunk rendezni
		*/
		
		/**
		 * order resz: kulcsai: by, limit
		 *
		 * @author Dobi Attila
		 */
		if (array_key_exists('order', $params) && is_array($params['order']) && in_array(strtolower($params['order']['dest']), array('asc', 'desc'))) {
		    
			$query->order_by($params['order']['by'], $params['order']['dest']);
		} else {
		    $query->order_by($this->_primary, 'desc');    
		}
		
		/**
		 * limit es offset resz
		 *
		 * @author Dobi Attila
		 */
		if (array_key_exists('limit', $params) /*&& is_array($params['limit'])*/ && is_numeric($params['limit']) && is_numeric($params['offset'])) {
		    
		    $query->limit($params['limit'], $params['offset']);
		}
		
		$result = $query->get()->result();
		
		if ($current && count($result) === 1) {
		    
		    $result = current($result);
		}
		
		return $result;	
	}
	
	/**
	 * csak bizonyos sorokat ad vissza
	 *
	 * @param array $params a kovetkezo kulcsokkal rendelkezhet: columns, join, where, order, limit, offset
	 * @return object
	 * @author Dobi Attila
	 */
	public function fetchRows($params, $current = false, $unprotected = false, $showSelfColumns = true) 
	{
		
		$db = $this->db;

		/**
		 * osszepakoljuk a $params['columns']-ban kapott oszlopokbol az oszlopok listajat
		 *
		 * @author Dobi Attila
		 */
		if ($showSelfColumns) {
		    
		    $cols = "$this->_name.*";
		} else {
		    
		    $cols = "";
		}
		
		if (array_key_exists('columns', $params)) {
		    
			if ($cols) {
				$cols .= ', ';
			}
			
		    $cols .= join(', ', $params['columns']);   
		}
		
		/**
		 * osszepakoljuk a $params['join']['columns']-ban kapott oszlopokbol a kapcsolt tabla oszlopaibol a listat
		 *
		 * @author Dobi Attila
		 */
		if (array_key_exists('join', $params)) {
		    
            $c = array();
    	    foreach ($params['join'] as $j) {
    	        
    	        if (array_key_exists('columns', $j)) {
    	            
    	            $c[] = join(', ', $j['columns']);    
    	        }
    	    }
    	    
    	    if (!empty($c)) {
    	        
    		    $cols .= ', ' . implode(',', $c);
    	    }
		}
		
		if (!$unprotected) {
		    
			$query = $db->select($cols)->from($this->_name);
		} else {
		    $query = $db->select($cols, false)->from($this->_name);
		}
		
		/**
         * join osszerakasa. $params['join'] kulcsai: tabla, condition
		 *
		 * @author Dobi Attila
		 */
		if (array_key_exists('join', $params)) {
		    
		    foreach ($params['join'] as $j) {
		        
		        $query->join($j['table'], $j['condition'], 'left');
		    }    	    		
		}
		
		$query->where($params['where']);
		
		/**
		 * group by resz
		 *
		 * @author Dobi Attila
		 */
		if (array_key_exists('group_by', $params)) {
		    
		    $query->group_by($params['group_by']);
		}
		
		/**
		 * order resz: kulcsai: by, limit
		 *
		 * @author Dobi Attila
		 */
		if (array_key_exists('order', $params) && is_array($params['order']) && in_array(strtolower($params['order']['dest']), array('asc', 'desc'))) {
		    
			$query->order_by($params['order']['by'], $params['order']['dest']);
		}
		
		/**
		 * limit es offset resz
		 *
		 * @author Dobi Attila
		 */
		if (array_key_exists('limit', $params) /*&& is_array($params['limit'])*/ && is_numeric($params['limit']) && is_numeric($params['offset'])) {
		    
		    $query->limit($params['limit'], $params['offset']);
		}
		
		$result = $query->get()->result();
		
		if ($current && count($result) === 1) {
		    
		    $result = current($result);
		}
		
		return $result;
	
	}
	
	/**
	 * azonosito alapjan megkeres egy sort az adatbazisban, es visszater vele
	 *
	 * @param int $id 
	 * @return array
	 * @author Dobi Attila
	 */
	public function find($id, $isXML = false) 
	{
		$db = $this->db;
		
		$where = array($this->_quote($this->_primary) => $id);
		
		$query = $db->select()->from($this->_name)->where($where);
		
		if ($isXML) return $this->toXML($query->get());
		
		return $query->get()->row();		
	}
	
	/**
	 * eldonti egy azonositorol, hogy letezik e ilyen az adatbazisban
	 *
	 * @param int $id 
	 * @return boolean
	 * @author Dobi Attila
	 */
	public function exists($id) 
	{
	    if (!$id) {
	        
	        return false;
	    }
	    
		$row = $this->find($id);
		
		$id = $this->_primary;
		
		return isset($row->$id);
	}
	
	/**
	 * update: a $data tomb a tabla oszlopaival megegyezo nevu kulcsokat tartalmaz.
	 *
	 * @param array $data 
	 * @param array $where 
	 * @return integer
	 * @author Dobi Attila
	 */
	public function update($data, $where='') 
	{
		
		$db = $this->db;
		
		if (!is_array($data) || empty($data)) {
		    
		    return false;
		}
		
		if (!is_array($where) && is_numeric($where)) {
		    $_w = $where;
		    $where = array($this->_primary=>$_w);
		}
		//dump($where); dump($data);
		$db->update($this->_name, $data, $where);
		
		return $db->affected_rows();
	}
	
	/**
	 * beszur egy sort az adatbazisba
	 *
	 * @param array $data 
	 * @return integer
	 * @author Dobi Attila
	 */
	public function insert($data) 
	{
		
		$db = $this->db;
		
		//dump($db); die;
		
		$db->insert($this->_name, $data);
		
		return $db->insert_id();
	}
	
	/**
	 * torol egy sort az adatbazisbol, azonosito alapjan
	 *
	 * @param int $id 
	 * @return integer
	 * @author Dobi Attila
	 */
	public function delete($id) 
	{
		$db = $this->db;

		if (!is_array($id) && !$this->exists($id)) {
		    
		    return false;
		}

		$where = false;
		if (!is_array($id)) {
		    $where = array($this->_quote($this->_primary)=>$id);
		} else {
		    $where = $id;
		}
        
		$db->delete($this->_name, $where);
		
		return $db->affected_rows();
	}

	/**
	 * vegrehajt a paramterben kapott tetszoleges sql utasitast
	 *
	 * @param string $sql 
	 * @return object - result set object
	 * @author Dobi Attila
	 */
	public function execute($sql, $onlyResult = false) 
	{
		if (!$sql) {
		    
		    return false;
		}
		
		$r = $this->db->query($sql);
		
		if ($onlyResult) return $r;
		
		return is_object($r) ? $r->result() : $this->db->affected_rows();
	}
	
	/**
	 * ize idezojelek koze tesz egy stringet, hogy a mysql nem akadjon ki
	 *
	 * @param string $column 
	 * @return string
	 * @author Dobi Attila
	 */
	protected function _quote($column)
	{
	    return "`" . $column . "`";
	}
	
    public function count($condition = array()) 
    {
        return empty($condition) ? count($this->fetchAll()) : count($this->fetchRows(array('where'=>$condition)));
    }	
	
	public function toAssocArray($key, $value, $data) 
	{
	    $ret = array(0=>'');
	    
	    $valuesArray = explode('+', $value);
	    
	    
	    if ($data) {
	        foreach ($data as $d) {
	            $r = array();
	            foreach ($valuesArray as $v) {
	            	if ($d->$v)
	                	$r[] = $d->$v;   
	            }
	            
	            $ret[$d->$key] = implode(' - ', $r);
	        }
	    }
	    
	    return $ret;
	}
	
	public function toXML($query, $config = array())
	{
	    $this->load->dbutil();
        $c = array(
          'newline' => "\n",
          'tab'    => "\t"
        );
        
        if ($config) {
            foreach ($config as $i=>$item) { 
                $c[$i] = $item;
            }
        }
        
        return  $this->dbutil->xml_from_result($query, $c); 	    
	}
	
	public function findBy($columns, $value)
	{
	    $result = $this->fetchRows(array('where'=>array($columns=>$value)));
	    
	    return $result ? $result[0] : false;
	}
}
