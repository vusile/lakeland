<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backend extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->database();
		$this->load->helper('url');
		
		$this->load->library('grocery_CRUD');	
				
		$this->load->library('image_CRUD');

	}
	
	function _example_output($output = null)
	{
		if ($this->ion_auth->logged_in())
			$this->load->view('example.php',$output);
		else
			redirect('login');
	}	
	
	function _example_images_output($output = null)
	{
		if ($this->ion_auth->logged_in())
			$this->load->view('example_images.php',$output);
		else
			redirect('login');
	}	
	
	function lakeland_settings()
	{
		$this->grocery_crud->unset_delete();
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}
	
	function lakeland_sections()
	{
		$this->grocery_crud->unset_delete();
		$this->grocery_crud->set_relation('parent','lakeland_sections','name');
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}
	
	
	function lakeland_directory()
	{
		
		$this->grocery_crud->set_relation('company_type','lakeland_company_types','title');
		$this->grocery_crud->set_relation('sector','lakeland_company_sectors','title');
		$this->grocery_crud->set_field_upload('logo', 'images');
		$this->grocery_crud->callback_after_insert(array($this, 'directory_callback'));
		$this->grocery_crud->callback_after_update(array($this, 'directory_callback'));
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}	
	
	function directory_callback($post_array, $primary_key)
	{
		$this->db->where('id',$primary_key);
		$directories= $this->db->get('lakeland_directory');
		
		
		
		$directory = $directories->row();
		
		$logo = $directory->logo;
		
		//echo $logo;
		
		
		$this->load->library('image_moo');
		$sizes = getimagesize('images/' . $logo);
		
		$source_image = 'images/' . $logo;
		
		$width = $sizes[0];
		$height = $sizes[1];
		

		/*
		if($width >= $height and $width > 200 and ($width-$height>=100))				
			$this->image_moo->load($source_image)->resize(200,999999999999)->save( $source_image,$overwrite=TRUE);
		else if($width <= $height and $height > 100 )
			$this->image_moo->load($source_image)->resize(999999999999,100)->save( $source_image,$overwrite=TRUE);	
			*/

		//if($width >= $height and $width > 200 and ($width-$height>=100))				
		$this->image_moo->load($source_image)->set_background_colour("#FFF")->resize(200,100,TRUE)->save( $source_image,$overwrite=TRUE);
		//else if($width <= $height and $height > 100 )
		//	$this->image_moo->load($source_image)->set_background_colour("#FFF")->resize(200,100,TRUE)->save( $source_image,$overwrite=TRUE);
			
			
		//else
		
		//$this->image_moo->load($source_image)->resize(250,100)->save( $source_image,$overwrite=TRUE);
	}
	
	function lakeland_newsletters()
	{
		$this->grocery_crud->unset_fields('url','identifier');
		$this->grocery_crud->set_relation_n_n('news_articles','lakeland_newsletter_news','lakeland_news','newsletter_id','news_id','title','priority');
		$this->grocery_crud->callback_after_insert(array($this, 'generate_newsletter_url'));
		$this->grocery_crud->callback_after_update(array($this, 'generate_newsletter_url'));
		$this->grocery_crud->unset_columns('identifier');
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}
	

	function generate_newsletter_url($post_array,$primary_key)
	{

		
		$this->db->where('id',$primary_key);
		$title_obj=$this->db->get('lakeland_newsletters');
		
		if($title_obj->row()->url == '')
		{
			$data['url'] = base_url() . 'nl/' . $this->convert_url('lakeland_newsletters', 'url', $title_obj->row()->newsletter_subject);
			$data['identifier'] = $this->convert_url('lakeland_newsletters', 'url', $title_obj->row()->newsletter_subject);
			$this->db->where('id',$primary_key);
			$this->db->update('lakeland_newsletters',$data);
		}
		
		
		return true;
	}
	
	function lakeland_pages()
	{
		try {
	//	$this->grocery_crud->unset_delete();
		$this->grocery_crud->set_relation('parent_page','lakeland_pages','title');
		$this->grocery_crud->set_relation('section','lakeland_sections','name');
		$this->grocery_crud->unset_fields('thumbnail','identifier');
		$this->grocery_crud->unset_columns('thumbnail','identifier');
		$this->grocery_crud->callback_after_insert(array($this, 'generate_thumb'));
		$this->grocery_crud->callback_after_update(array($this, 'generate_thumb'));
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}	
	
	function generate_thumb($post_array,$primary_key)
	{
		$doc = new DOMDocument();
		@$doc->loadHTML($post_array['text']);

		$tags = $doc->getElementsByTagName('img');
		$count = 0;
		
		if(count($tags)>0)
		{
			foreach ($tags as $tag) {
				if($count > 0)
					break;
				else
					$src =  $tag->getAttribute('src');
					
				$count++;
			}
			
			$name = explode('/',$src);
			
			$index = count($name);
			
			$data['thumbnail'] = $name[$index-1];	
			
			$this->db->where('id',$primary_key);
			$this->db->update('lakeland_pages',$data);
		}
		
	}
	
	function lakeland_company_sectors()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);

	}	
	
	function lakeland_team()
	{
		$this->grocery_crud->callback_after_insert(array($this, 'team_callback'));
		$this->grocery_crud->callback_after_update(array($this, 'team_callback'));
		$this->grocery_crud->set_field_upload('photo', 'images');
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}
	
	function team_callback($post_array, $primary_key)
	{
		$this->db->where('id',$primary_key);
		$members= $this->db->get('lakeland_team');
		
		
		
		$member = $members->row();
		
		$photo = $member->photo;
		
		//echo $logo;
		
		
		$this->load->library('image_moo');
		$sizes = getimagesize('images/' . $photo);
		
		$source_image = 'images/' . $photo;
		
		$width = $sizes[0];
		$height = $sizes[1];
		
		//echo $width;
		
		//die();
		
		if($width >= $height and $width > 400)				
			$this->image_moo->load($source_image)->resize(400,999999999999)->save( $source_image,$overwrite=TRUE);
		else if($width <= $height and $height > 400)
			$this->image_moo->load($source_image)->resize(999999999999,400)->save( $source_image,$overwrite=TRUE);
	}
	
	function lakeland_company_types()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);

	}

	
	function lakeland_projects_and_publications($section)
	{
		$this->grocery_crud->set_relation('parent_category','lakeland_projects_and_publications','title',array('section' => $section, 'parent_category' =>''));
	
		$this->grocery_crud->unset_fields('section','url','link');
		$this->grocery_crud->unset_columns('section','url');		
		
		if($section == 1)
		{
			$this->grocery_crud->display_as ( 'link' , 'Projects' );
			$this->grocery_crud->callback_after_insert(array($this, 'generate_projects_link'));
			$this->grocery_crud->callback_after_update(array($this, 'generate_projects_link'));
			
		}
		else if($section == 2)
		{
			$this->grocery_crud->display_as ( 'link' , 'Publications' );
			$this->grocery_crud->callback_after_insert(array($this, 'generate_publications_link'));
			$this->grocery_crud->callback_after_update(array($this, 'generate_publications_link'));
		}	
			
		$this->db->where('lakeland_projects_and_publications.section',$section);
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}
	
	function lakeland_publications($id)
	{
		
		$this->grocery_crud->set_field_upload('publication_file','publications');
		$this->grocery_crud->callback_after_insert(array($this, 'set_publications_category'));
		$this->grocery_crud->callback_after_update(array($this, 'set_publications_category'));
		
		$this->grocery_crud->where('category',$id);
		$this->grocery_crud->unset_fields('category','thumb_nail');
		$this->grocery_crud->unset_columns('category','thumb_nail');	
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}
	
	function lakeland_projects($id)
	{
		
		$this->grocery_crud->set_relation_n_n('partners','lakeland_projects_partners','lakeland_directory','project','partner','company_name');
		$this->grocery_crud->set_relation('featured','lakeland_options','title');
		$this->grocery_crud->callback_after_insert(array($this, 'set_projects_category'));
		$this->grocery_crud->callback_after_update(array($this, 'set_projects_category'));
		$this->grocery_crud->where('category',$id);
		$this->grocery_crud->display_as('text','Project Description');
		$this->grocery_crud->unset_fields('url','category','thumb_nail');
		$this->grocery_crud->unset_columns('url','category','thumb_nail');	
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}
	
	function set_publications_category($post_array,$primary_key)
	{
		$data = array (
			'category' => $this->uri->segment(3)
		);
		
		
		$doc = new DOMDocument();
		@$doc->loadHTML($post_array['text']);

		$tags = $doc->getElementsByTagName('img');
		$count = 0;
		
		if(count($tags)>0)
		{
			foreach ($tags as $tag) {
				if($count > 0)
					break;
				else
					$src =  $tag->getAttribute('src');
					
				$count++;
			}
			
			$name = explode('/',$src);
			
			$index = count($name);
			
			$data['thumb_nail'] = $name[$index-1];	

		}
		
		
		$this->db->where('id',$primary_key);
		$this->db->update('lakeland_publications',$data);

		return true;
	}
	
	function set_projects_category($post_array,$primary_key)
	{
		$data = array (
			'category' => $this->uri->segment(3)
		);
		
		$this->db->where('id',$primary_key);
		$title_obj=$this->db->get('lakeland_projects');
		
		if($title_obj->row()->url == '')
		{
			$data['url'] = $this->convert_url('lakeland_projects', 'url', $title_obj->row()->title);
		}
		
		
		$doc = new DOMDocument();
		@$doc->loadHTML($post_array['text']);

		$tags = $doc->getElementsByTagName('img');
		$count = 0;
		
		if(count($tags)>0)
		{
			foreach ($tags as $tag) {
				if($count > 0)
					break;
				else
					$src =  $tag->getAttribute('src');
					
				$count++;
			}
			
			$name = explode('/',$src);
			
			$index = count($name);
			
			$data['thumb_nail'] = $name[$index-1];	

		}

		
		$this->db->where('id',$primary_key);
		$this->db->update('lakeland_projects',$data);
		
		if($post_array['featured'] == 1)
		{
			$featured = array (
				'featured' => 2
			);
			$this->db->where('id <>',$primary_key);
			$this->db->update('lakeland_projects',$featured);
		}
		
		return true;
	}
	
	function convert_url($table, $column, $text)
	{
		
		$cleanurl = preg_replace('/[^A-Za-z0-9\s]/i', ' ', $text); 
		// eliminates extra white spaces created above 
		$cleanurl = preg_replace('/\s\s+/', ' ', $cleanurl); 
		// replaces white space with a hyphen 
		$cleanurl = str_replace(' ', '-', $cleanurl); 
		// removes any hyphen from beginning of string 
		$cleanurl = preg_replace('/^-/', '', $cleanurl); 
		// removes any hyphen from end of string 
		$cleanurl = preg_replace('/-$/', '', $cleanurl); 
		// makes all letters lower case 
		$cleanurl = strtolower($cleanurl); 
		
		//$cleanurl = $this->check_clean_url($table,$column,$cleanurl,$composer);
		
		$this->db->where($column,$cleanurl);
		$cleancheck = $this->db->get($table);
		
		if($cleancheck->num_rows() == 0)
		{
			return $cleanurl;
		}
		else
		{

			$cleanurl = $cleanurl . '-' . $cleanurl;
			return $cleanurl;
		}
		
		//return $cleanurl;	
		
	}
	
	
	function generate_publications_link($post_array,$primary_key)
	{	
	
		$data = array (
			'link' => '<a target = "_blank" href = "' . base_url() . 'backend/lakeland_publications/' . $primary_key .'">Publications</a>',
			'section' => $this->uri->segment(3)
		);
		
		$this->db->where('id',$primary_key);
		$title_obj=$this->db->get('lakeland_projects_and_publications');
		
		if($title_obj->row()->url == '')
		{
			$data['url'] = $this->convert_url('lakeland_projects_and_publications', 'url', $title_obj->row()->title);
		}
		
		
		$this->db->where('id',$primary_key);
		$this->db->update('lakeland_projects_and_publications',$data);
		
		return true;
	}	
	
	function generate_projects_link($post_array,$primary_key)
	{
		
		$data = array (
			'link' => '<a target = "_blank" href = "' . base_url() . 'backend/lakeland_projects/' . $primary_key .'">Projects</a>',
			'section'=> $this->uri->segment(3)
		);
		
		$this->db->where('id',$primary_key);
		$title_obj=$this->db->get('lakeland_projects_and_publications');
		
		if($title_obj->row()->url == '')
		{
			$data['url'] = $this->convert_url('lakeland_projects_and_publications', 'url', $title_obj->row()->title);
		}
		
		$this->db->where('id',$primary_key);
		$this->db->update('lakeland_projects_and_publications',$data);
		
		return true;
	}
	
	function lakeland_news()
	{
		
		$this->grocery_crud->unset_fields('url','date','thumb_nail');
		$this->grocery_crud->unset_columns('url','thumb_nail');	
		$this->grocery_crud->order_by('date','desc');	
		$this->grocery_crud->callback_after_insert(array($this, 'add_url_to_news'));
		$this->grocery_crud->callback_after_update(array($this, 'add_url_to_news'));
		
		
		$output = $this->grocery_crud->render();
		$this->_example_output($output);

	}
	
	function add_url_to_news($post_array,$primary_key)
	{
	
		$doc = new DOMDocument();
		@$doc->loadHTML($post_array['text']);

		$tags = $doc->getElementsByTagName('img');
		$count = 0;
		
		if(count($tags)>0)
		{
			foreach ($tags as $tag) {
				if($count > 0)
					break;
				else
					$src =  $tag->getAttribute('src');
					
				$count++;
			}
			
			$name = explode('/',$src);
			
			$index = count($name);
			
			$data['thumb_nail'] = $name[$index-1];
			
			
			/*$this->load->library('image_moo');
			$sizes = getimagesize($src);
			
			$width = $sizes[0];
			$height = $sizes[1];
			
			if($width >= $height and $width > 90)				
				$this->image_moo->load($source_image)->resize(90,999999999999)->save('thumb_' . $source_image,$overwrite=TRUE);
			else if($width <= $height and $height > 90)
				$this->image_moo->load($source_image)->resize(999999999999,90)->save('thumb_' . $source_image,$overwrite=TRUE);*/
		}
		
		$this->db->where('id',$primary_key);
		$title_obj=$this->db->get('lakeland_news');
		
		$data['date'] = date('Y-m-d');
		if($title_obj->row()->url == '')
		{
			$data['url'] = $this->convert_url('lakeland_news', 'url', $title_obj->row()->title);
		}
		
		$this->db->where('id',$primary_key);
		$this->db->update('lakeland_news',$data);
		return true;
		
	}
	
	function lakeland_overland_safaris_packages()
	{

		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}
	
	function index()
	{
		if ($this->ion_auth->logged_in())
			$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
		else
			redirect('login');
	}

	function lakeland_safaris($safari_type=1)
	{
		$this->db->where('safari_type',$safari_type);
		$safaris=$this->db->get('lakeland_safaris');
		$image_array = array();
		if($safaris->num_rows() > 0)
		{
			foreach($safaris->result() as $safari)
			{
				$this->db->where('safari',$safari->id);
				$this->db->where('priority',1);
				$images = $this->db->get('lakeland_safari_images');
				
				if($images->num_rows() == 0)
				{
					$this->db->where('safari',$safari->id);
					$this->db->limit(1);
					$images = $this->db->get('lakeland_safari_images');
					
					if($images->num_rows() == 0)
						continue;
				}
				
				$image = $images->row()->image;
				$image_array[] = array('id'=>$safari->id,'thumb_nail'=>'<img width = "100" src = "images/thumb__' . $image . '" />');
				
			}
			
			//print_r($image_array);
			//die();
			if($images->num_rows()>0)
			$this->db->update_batch('lakeland_safaris',$image_array,'id');
		}
		
		if($safari_type == 3)
		{
			$this->grocery_crud->display_as('introductory_text','Tour Description');
			$this->grocery_crud->unset_fields('thumb_nail','itinerary','images','type','includes','excludes');
			$this->grocery_crud->unset_columns('itinerary','includes','excludes','type','schedule');
		}
		
		else if($safari_type == 2)
		{
			$this->grocery_crud->unset_fields('thumb_nail','itinerary','images','type');
			$this->grocery_crud->unset_columns('type','schedule');
		}
		else
		{
			$this->grocery_crud->unset_columns('schedule');
			$this->grocery_crud->unset_fields('thumb_nail','itinerary','images');
		}	
		
		if($safari_type == 1)
			$this->grocery_crud->set_relation('type','lakeland_overland_safaris_packages','title',null,'id ASC');
		$this->grocery_crud->where('safari_type',$safari_type);
		//$this->grocery_crud->unset_fields('thumb_nail','itinerary','images');
		$this->grocery_crud->callback_after_insert(array($this, 'safaris_callback'));
		$this->grocery_crud->callback_after_update(array($this, 'safaris_callback'));
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}
	
	function safaris_callback($post_array,$primary_key)
	{
		$data = array();
		$data['images'] = '<a href = "backend/images/' . $primary_key . '/' . $this->uri->segment(3) . '">Images</a>'; 
		$data['itinerary'] = '<a href = "backend/lakeland_itinerary/' . $primary_key .  '/' . $this->uri->segment(3) . '">Itinerary</a>';
		$data['schedule'] = '<a href = "backend/lakeland_scheduled_trips/add/' . $primary_key .  '">Schedule</a>';
		$data['safari_type'] = $this->uri->segment(3);
		$this->db->where('id',$primary_key);
		$this->db->update('lakeland_safaris', $data);

	}

	
	
	function images()
	{
		$image_crud = new image_CRUD();
	
		$image_crud->set_primary_key_field('id');
		$image_crud->set_url_field('image');
		$image_crud->set_title_field('title');
		$image_crud->set_table('lakeland_safari_images')
		->set_ordering_field('priority')
		->set_relation_field('safari')
		->set_image_path('images');
			
		$output = $image_crud->render();
	
		$this->_example_images_output($output);
	}
	
	function lakeland_itinerary($safari)
	{
		$trip=$this->db->get_where('lakeland_safaris',array('id'=>$safari));
		$name = $trip->row()->title;
		//$type 
		
		$this->grocery_crud->where('safari',$safari);
		$this->grocery_crud->set_subject('Itinerary for ' . $name);
		$this->grocery_crud->unset_fields('safari');
		$this->grocery_crud->unset_columns('safari');
		$this->grocery_crud->callback_after_insert(array($this, 'itinerary_callback'));
		$this->grocery_crud->callback_after_update(array($this, 'itinerary_callback'));
		
		
		$output = $this->grocery_crud->render();
		$output->additional_text='<a href = "backend/lakeland_safaris/' . $this->uri->segment(4) . '">Return to Safaris</a>';
		//print_r ($output);
		$this->_example_output($output);
	}
	
	function itinerary_callback($post_array,$primary_key)
	{
			$data = array (
			
			'safari'=> $this->uri->segment(3)
			
		);
		
		$this->db->where('id',$primary_key);
		$this->db->update('lakeland_itinerary',$data);
	
	}
	
	function lakeland_scheduled_trips()
	{
		//$this->grocery_crud->callback_after_insert(array($this, 'scheduled_trips_callback'));
		//$this->grocery_crud->callback_after_update(array($this, 'scheduled_trips_callback'));
		//$this->grocery_crud->unset_fields('trip');
		$this->grocery_crud->set_relation('trip','lakeland_safaris','title');
		$output = $this->grocery_crud->render();


		$this->_example_output($output);

	}
	
	function scheduled_trips_callback($post_array, $primary_key)
	{
		//echo $this->uri->segment(4);
		$data = array( 'trip' => 1);
		$this->db->where('id',$primary_key);
		$this->db->update('lakeland_scheduled_trips',$data);
	}
	
	
	function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}
	

	
}