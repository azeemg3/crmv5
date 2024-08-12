<?php

	class utils{
		
		var	$css_files	=	array();
		var	$js_files	 =	array();	
		
		function load_css(){
			if(!empty($this->css_files)){
				
				foreach($this->css_files as $css){
					echo $css."\n";
					
				}
				
			}
				
		}
		
		function add_css($css,$css_dir='bootstrap/css',$media='all',$id=''){
			$css_path	=	$css_dir.'/'.$css;
			if(empty($id)){
				$id		=	str_replace(".","_",$css);
			}
			$this->css_files[]	="<link href=\"$css_path\" rel=\"stylesheet\" type=\"text/css\" media=\"$media\">";
		}
		
		function load_js(){
			if(!empty($this->js_files)){
				
				foreach($this->js_files as $js){
					echo $js."\n";
					
				}
				
			}
				
		}
		
		function add_js($js,$js_dir='plugins/jQuery',$id=''){
			$js_path	=	$js_dir.'/'.$js;
			if(empty($id)){
				$id		=	str_replace(".","_",$js);
			}
			$this->js_files[]	="<script src=\"$js_path\" type=\"text/javascript\"></script>";
		}
		
		function safe_redirect($url){
				@header("Location:$url");
			}
			
		function notification($message,$type='danger'){
					
				if($type=='danger'){
					$icon	=	'fa-ban';
					}else{
						$icon	=	'fa-check';
					}
			
			return '<div class="alert alert-'.$type.' alert-dismissable callout callout-'.$type.'">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<i class="icon fa '.$icon.'"></i> 
			'.$message.'
		  </div>';
		}

	}

?>