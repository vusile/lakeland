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
	
	function make_url_from_title($title,$table,$id)
	{
		$url = strtolower(url_title($title));
		

		$this->db->where('id',$id);
		//$this->db->where('url',$url);
		$obj=$this->db->get($table);
		
		if($obj->row()->url !='')
			return $obj->row()->url;
			
		else
		{
			$this->db->where('url',$url);
			$obj=$this->db->get($table);
			
			if( $obj->num_rows() > 0 )
				$url = $this->make_url_from_title($url . '-' . $url,$table,$id);
		}
		
		return $url;
		
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
	
	
	
	function lakeland_pages()
	{
		try {
	//	$this->grocery_crud->unset_delete();
		$this->grocery_crud->set_relation('parent_page','lakeland_pages','title');
		$this->grocery_crud->set_relation('section','lakeland_sections','name');
		$this->grocery_crud->unset_fields('thumbnail','identifier','alternate_browser_title','url');
		$this->grocery_crud->unset_columns('thumbnail','identifier','alternate_browser_title','url');
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
			$data['url'] = $this->make_url_from_title($post_array['title'],'lakeland_pages',$primary_key);
			
			$this->db->where('id',$primary_key);
			$this->db->update('lakeland_pages',$data);
		}
		
	}
	
	function lakeland_destinations()
	{
		$destinations=$this->db->get('lakeland_destinations');
		$image_array = array();
		if($destinations->num_rows() > 0)
		{
			foreach($destinations->result() as $destination)
			{
				$this->db->where('destination',$destination->id);
				$this->db->where('priority',1);
				$images = $this->db->get('lakeland_destination_images');
				
				if($images->num_rows() == 0)
				{
					$this->db->where('destination',$destination->id);
					$this->db->limit(1);
					$images = $this->db->get('lakeland_destination_images');
					
					if($images->num_rows() == 0)
						continue;
				}
				
				$image = $images->row()->image;
				$image_array[] = array('id'=>$destination->id,'thumb_nail'=>'<img width = "100" src = "images/thumb__' . $image . '" />');
				
			}
			
			//print_r($image_array);
			//die();
			if($images->num_rows()>0)
			$this->db->update_batch('lakeland_destinations',$image_array,'id');
		}
		$this->grocery_crud->unset_fields('thumb_nail','images','url');
		$this->grocery_crud->unset_columns('url');
		$this->grocery_crud->callback_after_insert(array($this, 'destinations_callback'));
		$this->grocery_crud->callback_after_update(array($this, 'destinations_callback'));
		$this->grocery_crud->set_relation('destination_type','lakeland_destination_types','title');
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}	
	
	function destinations_callback($post_array,$primary_key)
	{
		$data = array();
		$data['images'] = '<a href = "backend/destination_images/' . $primary_key . '/' . $this->uri->segment(3) . '">Images</a>'; 
		$data['url'] = $this->make_url_from_title($post_array['destination_name'],'lakeland_destinations',$primary_key);
		$this->db->where('id',$primary_key);
		$this->db->update('lakeland_destinations', $data);

	}
	
	function destination_images()
	{
		$image_crud = new image_CRUD();
	
		$image_crud->set_primary_key_field('id');
		$image_crud->set_url_field('image');
		$image_crud->set_title_field('title');
		$image_crud->set_table('lakeland_destination_images')
		->set_ordering_field('priority')
		->set_relation_field('destination')
		->set_image_path('images');
			
		$output = $image_crud->render();
		$output->additional_text = "<a href = 'backend/lakeland_destinations'>Return to Destinations</a>";
	
		$this->_example_images_output($output);
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
			$this->grocery_crud->unset_fields('thumb_nail','itinerary','images','type','includes','excludes','url','safari_type');
			$this->grocery_crud->unset_columns('itinerary','includes','excludes','type','schedule','url','safari_type');
		}
		
		else if($safari_type == 2)
		{
			$this->grocery_crud->unset_fields('thumb_nail','itinerary','images','type','url','safari_type');
			$this->grocery_crud->unset_columns('type','schedule','url','safari_type');
		}
		else
		{
			$this->grocery_crud->unset_columns('schedule','url','safari_type');
			$this->grocery_crud->unset_fields('thumb_nail','itinerary','images','url','safari_type');
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
		$data['url'] = $this->make_url_from_title($post_array['title'],'lakeland_safaris',$primary_key);
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
		$output->additional_text = "<a href = 'backend/lakeland_safaris/" . $this->uri->segment(4) . "'>Return to Safaris</a>";
	
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
	
	function lakeland_photo_albums()
	{
		$albums=$this->db->get('lakeland_photo_albums');
		$image_array = array();
		if($albums->num_rows() > 0)
		{
			foreach($albums->result() as $album)
			{
				$this->db->where('album',$album->id);
				$this->db->where('priority',1);
				$images = $this->db->get('lakeland_album_images');
				
				if($images->num_rows() == 0)
				{
					$this->db->where('album',$album->id);
					$this->db->limit(1);
					$images = $this->db->get('lakeland_album_images');
					
					if($images->num_rows() == 0)
						continue;
				}
				
				$image = $images->row()->image;
				$image_array[] = array('id'=>$album->id,'thumb_nail'=>'<img width = "100" src = "images/thumb__' . $image . '" />');
				
			}
			
			//print_r($image_array);
			//die();
			if($images->num_rows()>0)
			$this->db->update_batch('lakeland_photo_albums',$image_array,'id');
		}
		$this->grocery_crud->unset_fields('thumb_nail','images','url');
		$this->grocery_crud->unset_columns('url');
		$this->grocery_crud->callback_after_insert(array($this, 'albums_callback'));
		$this->grocery_crud->callback_after_update(array($this, 'albums_callback'));
		
		$output = $this->grocery_crud->render();
		$this->_example_output($output);
	}	
	
	function albums_callback($post_array,$primary_key)
	{
		$data = array();
		$data['images'] = '<a href = "backend/album_images/' . $primary_key . '/' . $this->uri->segment(3) . '">Images</a>'; 
		$data['url'] = $this->make_url_from_title($post_array['title'],'lakeland_photo_albums',$primary_key);
		$this->db->where('id',$primary_key);
		$this->db->update('lakeland_photo_albums', $data);

	}
	
	function album_images()
	{
		$image_crud = new image_CRUD();
	
		$image_crud->set_primary_key_field('id');
		$image_crud->set_url_field('image');
		$image_crud->set_title_field('title');
		$image_crud->set_table('lakeland_album_images')
		->set_ordering_field('priority')
		->set_relation_field('album')
		->set_image_path('images');
			
		$output = $image_crud->render();
		$output->additional_text = "<a href = 'backend/lakeland_photo_albums'>Return to Albums</a>";
	
		$this->_example_images_output($output);
	}
	
	
	
	
	function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}
	

	
}