<?
class Favorites{
	public $_plugins = array();
    const FILENAME = 'Favorites.class.php';
	
	function __construct(){
	   $iterator = new RecursiveIteratorIterator(
                        new RecursiveDirectoryIterator(
                            "./classes", FilesystemIterator::KEY_AS_PATHNAME | FilesystemIterator::CURRENT_AS_FILEINFO));
       foreach ($iterator as $key) {
            if(self::FILENAME != $key->getFilename()) require_once $key->getPathname();
       }
       $this->findPlugins();
	}
	
    private function findPlugins(){
       $iterator = new ArrayIterator(array_reverse(get_declared_classes()));
       foreach ($iterator as $val) {
          $ref = new ReflectionClass($val);
          if($ref->isUserDefined() && $ref->implementsInterface('IPlugin')) $this->_plugins[$val] = new $val;
       }
	}
	
	function getFavorites($methodName) {
		$list = array();
        foreach ($this->_plugins as $key => $val) {
            $ref = new ReflectionClass($val);
            if($ref->hasMethod($methodName)){
                $met = $ref->getMethod($methodName);
                    if($met->isStatic()){
                        $res = $met->invoke(null);
                        $list[] = $res;
                        $res = null;
                    }else{
                        $inst = $ref->newInstance();
                        $res = $met->invoke($inst);
                        $list[] = $res;
                        $res = null; 
                    }   
            }
        }
        return $this->viewAll(new RecursiveIteratorIterator(new RecursiveArrayIterator($list)));
	}
    private function viewAll(Iterator $iterator){
        foreach ($iterator as $key => $val) {
            if(is_int($key)) $res .= "\n<li><<< $val >>></li>";
            else $res .= "\n<li><<< $key || $val >>></li>";
        }
        return $res;
    }
}