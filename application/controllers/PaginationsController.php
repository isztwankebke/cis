<?php
class PaginationsController {
	
	private $nrOfRows = 10;
	private $minPage = 1;
	private $defaultPage = 1;
	private $offset;
	
	
	
	public function setPaginationAttributes($limit = null, $pageNr = null) {
		
		try {
			
			if ($limit) {
				
				$this->nrOfRows = $limit;
			}
			
			if ($pageNr) {
				
				$this->defaultPage = $pageNr;
			}
			
			$this->offset = ($this->defaultPage - 1) * $this->nrOfRows;
			
			$attribute = array('limit' => $this->nrOfRows,
								'offset' => $this->offset,
								'pageNr' => $this->defaultPage
					
								);
			return $attribute;
			
		}
		catch (Exception $e) {
			
			echo "Caught exception: ", $e->getMessage();
		}
		
	}
		
}