<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	 
	function schedule()
	{
		
		$query = "select saf.title, saf.url, sch.start_date, sch.end_date from lakeland_safaris saf, lakeland_scheduled_trips sch where saf.id = sch.trip and start_date > '" . date('Y-m-d') . "' order by start_date limit 3";

		$dates = $this->db->query($query);
		
		$schedule = array();
		
		foreach($dates->result() as $dt)
		{
			$schedule[date('m-Y',strtotime($dt->start_date))][$dt->url] = date('d-m-Y',strtotime($dt->start_date)) . '---' . date('d-m-Y',strtotime($dt->end_date)) . ' > ' . $dt->title ;
		}
				
		$interval = 12;
		$date = new DateTime(date("d-m-Y"));
		
		$datas = array();
		
		$schedule_string = '';
		
		for($i=1;$i <= $interval; $i++)
		{
			$schedule_string .= '<h2>' . $date->format('F') . '</h2>';
			
			if(isset($schedule[$date->format('m') . '-' . $date->format('Y')]))
			{
				$schedule_string .= '<ul>';
				foreach($schedule[$date->format('m') . '-' . $date->format('Y')] as $key => $value)
					$schedule_string .=  '<li ><a href = "trip/'. $key  . '">' . str_replace('---', ' to ' , $value) . '</a></li>';
				$schedule_string .= '</ul>';
			}
			$date->add(new DateInterval('P1M'));
		}

		return $schedule_string;
	}
	 
	function menu()
	{
		$this->db->order_by('priority');
		$sections = $this->db->get('lakeland_sections');
		$menu = '';
		foreach($sections->result() as $section)
		{
			$this->db->where('section',$section->id);
			$pages = $this->db->get('lakeland_pages');
			if($pages->num_rows() >0)
			{
				$menu .= "<li><a href = '" . current_url() . "'>"  . $section->name .  "</a>";
				$menu .= "<ul class='subnav'>";	
				foreach($pages->result() as $page)
				{	
					$this->db->where('parent_page',$page->id);
					$sub_pages = $this->db->get('lakeland_pages');
					
					if($sub_pages->num_rows() > 0)
					{
						$menu .= "<li><a href = '" . current_url() . "'>"  . $page->title .  "</a>";
						$menu .= "<ul class='subnav'>";	
						
						foreach($sub_pages->result() as $sub_page)
							$menu .= "<li><a href = '" . $section->url_string . '/' . $sub_page->url . "'>"  . $sub_page->title .  "</a></li>";
						
						$menu .= "</ul></li>";
					}
					else
					
					$menu .= "<li><a href = '" . $section->url_string . '/' . $page->url . "'>"  . $page->title .  "</a></li>";
				}
					
				$menu .= "</ul></li>";
			}
			else
				$menu .= "<li><a href = '" . $section->url_string . "'>"  . $section->name .  "</a></li>";
		}
		
		return $menu;
		
	}

	function sidebar()
	{
		$query = "select saf.title, saf.url, sch.start_date, sch.end_date from lakeland_safaris saf, lakeland_scheduled_trips sch where saf.id = sch.trip order by start_date limit 3";
//		$this->db->limit(4);
	//	$this->db->order_by('start_date');
		//$trips = $this->db->get('lakeland_scheduled_trips');
		
		$trips = $this->db->query($query);
		
		//echo $trips->num_rows();
		
		return $trips;
		
	}
	 
	public function index()
	{
		$this->db->where('url','home');
		$content = $this->db->get('lakeland_pages');
		$data['details'] =  $content->row();
		$header['title'] = $data['details']->title;
		$header['description'] = strip_tags( preg_replace("/&#?[a-z0-9]{2,8};/i","",$data['details']->content));
		$sidebar['fb'] = 1;
		$sidebar['trips'] = $this->sidebar();
		$menu['menu'] = $this->menu();
		$this->load->view('header',$header);
		$this->load->view('menu',$menu);
		$this->load->view('sidebar',$sidebar);
		$this->load->view('home',$data);
		$this->load->view('footer');
	}
	
	public function home()
	{
		$this->index();
	}
	
	
	
	public function about()
	{		
		$this->db->where('url','about-lakeland-africa');
		$content = $this->db->get('lakeland_pages');
		$data['details'] =  $content->row();
		$header['title'] = $data['details']->title;
		$header['description'] = strip_tags( preg_replace("/&#?[a-z0-9]{2,8};/i","",$data['details']->content));
		$menu['menu'] = $this->menu();
		$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#" class="active">' . $data['details']->title . '</a></li>';
		$sidebar['trips'] = $this->sidebar();
		$this->load->view('header',$header);
		$this->load->view('menu',$menu);
		$this->load->view('sidebar',$sidebar);
		$this->load->view('day_tours_details',$data);
		$this->load->view('footer');
	}
	
	function vehicles($url)
	{
		$this->db->where('url',$url);
		$content = $this->db->get('lakeland_pages');
		

		$data['details'] =  $content->row();
		$header['title'] = $data['details']->title;
		$header['description'] = strip_tags( preg_replace("/&#?[a-z0-9]{2,8};/i","",$data['details']->content));
		$menu['menu'] = $this->menu();
		
		$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Safari Vehicles</a></li><li><a href="#" class="active">' . $data['details']->title . '</a></li>';
		$sidebar['trips'] = $this->sidebar();
		$this->load->view('header',$header);
		$this->load->view('menu',$menu);
		$this->load->view('sidebar',$sidebar);
		$this->load->view('day_tours_details',$data);
		$this->load->view('footer');
	}
	
	
	
	function carrentals($url)
	{
		$this->db->where('url',$url);
		$content = $this->db->get('lakeland_pages');
		
		
		$data['details'] =  $content->row();
		$header['title'] = $data['details']->title;
		//$header['description'] = strip_tags( preg_replace("/&#?[a-z0-9]{2,8};/i","",$data['details']->content));
		
		$menu['menu'] = $this->menu();
		$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Car Rentals</a></li><li><a href="#" class="active">' . $data['details']->title . '</a></li>';
		$sidebar['trips'] = $this->sidebar();
		$this->load->view('header',$header);
		$this->load->view('menu',$menu);
		$this->load->view('sidebar',$sidebar);
		$this->load->view('day_tours_details',$data);
		$this->load->view('footer');
	}
	
	public function destinations($url)
	{
		//$this->db->where('url',$url);
	//	$content = $this->db->get('lakeland_pages');
	
		switch($url)
		{
			case 'national-parks':
				
				$this->db->where('destination_type',1);

				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Destinations</a></li><li><a href="#" class="active">National Parks</a></li>';

				
			break;
			
			case 'beaches':
				$this->db->where('destination_type',2);
	
				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Destinations</a></li><a href="#" class="active">Beaches</a></li>';

			break;
			
			case 'cultural-tourism':
				$this->db->where('destination_type',3);

				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Destinations</a></li><li><a href="#" class="active">Cultural Tourism</a></li>';	

			break;
			
		}
		
		$this->db->select('*, destination_name as title, destination_description as introductory_text');
		$data['trips'] = $this->db->get('lakeland_destinations');

		
		$this->db->where('url',$url);
		$content = $this->db->get('lakeland_pages');
		$data['details'] =  $content->row();
		$header['title'] = $data['details']->title;
		$header['description'] = strip_tags( preg_replace("/&#?[a-z0-9]{2,8};/i","",$data['details']->content));
		$menu['menu'] = $this->menu();
		$sidebar['trips'] = $this->sidebar();
		$data['detail_url'] = 'destination';
		
		$this->load->view('header',$header);
		$this->load->view('menu',$menu);
		$this->load->view('sidebar',$sidebar);
		$this->load->view('day_tours',$data);
		$this->load->view('footer');
	}
	
	public function safaris($url)
	{
		$custom = 0;
		$scheduled = 0;
		$this->db->where('url',$url);
		$content = $this->db->get('lakeland_pages');
		
		switch($url)
		{
			case '21-40-tanzania-overland-safaris':
				$this->db->where('safari_type',1);
				$this->db->where('type',1);
				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="#">Overland Safaris</a></li><li><a href="#" class="active">21 - 40 Day Trips</a></li>';
				$data['trips'] = $this->db->get('lakeland_safaris');
				
			break;
			
			case '14-20-tanzania-overland-safaris':
				$this->db->where('safari_type',1);
				$this->db->where('type',2);
				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="#">Overland Safaris</a></li><li><a href="#" class="active">14 - 20 Day Trips</a></li>';
				$data['trips'] = $this->db->get('lakeland_safaris');
			break;
			
			case '7-13-tanzania-overland-safaris':
				$this->db->where('safari_type',1);
				$this->db->where('type',3);
				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="#">Overland Safaris</a></li><li><a href="#" class="active">7 - 13 Day Trips</a></li>';
				$data['trips'] = $this->db->get('lakeland_safaris');
			break;
			
			case 'weekend-getaways':
				$this->db->where('safari_type',2);
				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="#" class="active">Weekend Getaways</a></li>';
				$data['trips'] = $this->db->get('lakeland_safaris');	
			break;
			
			case 'day-tours':
				$this->db->where('safari_type',3);
				$data['hide_other_details'] = 1;
				$data['trips'] = $this->db->get('lakeland_safaris');	
				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="#" class="active">Day Tours</a></li>';
			break;
			
			case 'custom-packages':
				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="#" class="active">Custom Packages</a></li>';
				$beaches = array();
				$cultural = array();
				$parks = array();
				
				$custom = 1;
				$this->db->order_by('destination_type');
				$destinations = $this->db->get('lakeland_destinations');
				
				foreach($destinations->result() as $destination)
				{
					if($destination->destination_type == 1)
						$parks[$destination->url] = $destination->destination_name;
					else if($destination->destination_type == 2)
						$beaches[$destination->url] = $destination->destination_name;
					else if($destination->destination_type == 3)
						$cultural[$destination->url] = $destination->destination_name;
				}
				
				//print_r($parks); die();
				$word = strtoupper($this->randomAlphaNum(7));
		
		
				$this->load->helper('captcha');
				$vals = array(
				'word' => $word,
				'img_path'	 => './captcha/',
				'img_url'	 => 'captcha/',
				'font_path'	 => './captcha/fonts/arial.ttf',
				'img_width'	 => '200',
				'img_height' => 50,
				);
				
				$data['cap'] = create_captcha($vals);
			
				$cap_data = array(
				'captcha_time'	=> $data['cap']['time'],
				'ip_address'	=> $this->input->ip_address(),
				'word'	 => $data['cap']['word']
				);
				
				$query = $this->db->insert_string('lakeland_captcha', $cap_data);	
				$this->db->query($query);
				$data['parks'] = $parks;
				$data['beaches'] = $beaches;
				$data['cultural'] = $cultural;
				
			break;
			
			case 'scheduled-trips':
				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="#" class="active">Scheduled Trips</a></li>';
				$data['schedule'] = $this->schedule();
				$scheduled = 1;
			break;
			
		}
		
		$sidebar['trips'] = $this->sidebar();
		$data['details'] =  $content->row();
		$header['title'] = $data['details']->title;
		$header['description'] = strip_tags( preg_replace("/&#?[a-z0-9]{2,8};/i","",$data['details']->content));
		$data['detail_url'] = 'trip';
		$menu['menu'] = $this->menu();
		$this->load->view('header',$header);
		$this->load->view('menu',$menu);
		$this->load->view('sidebar',$sidebar);
		if($custom == 1)
			$this->load->view('custom',$data);
		else if ($scheduled == 1)
			$this->load->view('schedule',$data);
		else
			$this->load->view('day_tours',$data);
		$this->load->view('footer');
	}
	
	

	
	public function trip($url)
	{
		$this->db->where('url',$url);
		$safari = $this->db->get('lakeland_safaris');
		
		$data['safari'] = $safari->row();
			
		$this->db->where('safari', $data['safari']->id);
		$data['itinerary'] = $this->db->get('lakeland_itinerary');

		
		$this->db->order_by('priority');
		$this->db->where('safari', $data['safari']->id);
		$data['images'] = $this->db->get('lakeland_safari_images');
		$data['inquiry'] = 1;
		
		
		if($data['safari']->safari_type == 1)
		{
			switch($data['safari']->type)
			{
				case 1:
				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="#">Overland Safaris</a></li><li><a href="safaris/21-40-day-trips">21 - 40 Day Trips</a></li><li><a href="#" class="active">' . $data['safari']->title . '</a></li>';
				break;
				
				case 2:
				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="#">Overland Safaris</a></li><li><a href=""safaris/14-20-day-trips"">14 - 20 Day Trips</a></li><a href="#" class="active">' . $data['safari']->title . '</a></li>';
				break;
				
				case 3:
				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="#">Overland Safaris</a></li><li><a href=""safaris/7-13-day-trips"">7 - 13 Day Trips</a></li><li><a href="#" class="active">' . $data['safari']->title . '</a></li>';
				break;
				
			}
		}
		
		else if($data['safari']->safari_type == 2)			
			$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="safaris/weekend-getaways">Weekend Getaways</a></li><li><a href="#" class="active">' . $data['safari']->title . '</a></li>';		
			
		else if($data['safari']->safari_type == 3)			
			$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="safaris/day-tours">Day Tours</a></li><li><a href="#" class="active">' . $data['safari']->title . '</a></li>';
				

		
		
		
		//$data['details'] =  $content->row();
		$header['title'] = $data['safari']->title;
		$header['description'] = strip_tags( preg_replace("/&#?[a-z0-9]{2,8};/i","",$data['safari']->introductory_text));
		$menu['menu'] = $this->menu();
		$this->load->view('header',$header);
		$this->load->view('menu',$menu);
		//$this->load->view('sidebar');
		$this->load->view('summary',$data);
		$this->load->view('footer');
		
	}
	
	public function destination($url)
	{
		$this->db->where('url',$url);
		$this->db->select('*, destination_name as title, destination_description as introductory_text');
		$destination = $this->db->get('lakeland_destinations');
		
		$data['safari'] = $destination->row();
			
	
		$this->db->order_by('priority');
		$this->db->where('destination', $data['safari']->id);
		$data['images'] = $this->db->get('lakeland_destination_images');
		
		//$data['details'] =  $content->row();
		$header['title'] = $data['safari']->destination_name;
		$header['description'] = strip_tags( preg_replace("/&#?[a-z0-9]{2,8};/i","",$data['safari']->introductory_text));
		$menu['menu'] = $this->menu();
		$this->load->view('header',$header);
		$this->load->view('menu',$menu);
		//$this->load->view('sidebar');
		$this->load->view('summary',$data);
		$this->load->view('footer');
		
	}
	
	
	public function contact($url = '')
	{
	
	
		$word = strtoupper($this->randomAlphaNum(7));
		
		
		$this->load->helper('captcha');
		$vals = array(
		'word' => $word,
		'img_path'	 => './captcha/',
		'img_url'	 => 'captcha/',
		'font_path'	 => './captcha/fonts/arial.ttf',
		'img_width'	 => '200',
		'img_height' => 50,
		);
		
		$data['cap'] = create_captcha($vals);
	
		$cap_data = array(
		'captcha_time'	=> $data['cap']['time'],
		'ip_address'	=> $this->input->ip_address(),
		'word'	 => $data['cap']['word']
		);
		
		$query = $this->db->insert_string('lakeland_captcha', $cap_data);	
		$this->db->query($query);
		
		if($url != '')
		{
			$data['subject'] = '';
			$subject = explode('-',$url);
			foreach($subject as $sub)
				$data['subject'] .= $sub . ' ';
		}
		$this->db->where('url','contact-us');
		$content = $this->db->get('lakeland_pages');
		$data['details'] =  $content->row();
		$header['title'] = $data['details']->title;
		
		$menu['menu'] = $this->menu();
		$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#" class="active">' .  $data['details']->title  . '</a></li>';
		$sidebar['trips'] = $this->sidebar();
		$this->load->view('header',$header);
		$this->load->view('menu',$menu);
		$this->load->view('sidebar',$sidebar);
		$this->load->view('contact',$data);
		$this->load->view('footer');
	}
	
	
	public function login()
	{

		$menu['menu'] = $this->menu();
		$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#" class="active">Login</a></li>';
		$sidebar['trips'] = $this->sidebar();
		$header['title'] = 'Login';
		$this->load->view('Header',$header);
		$this->load->view('menu',$menu);
		$this->load->view('sidebar',$sidebar);
		$this->load->view('Login');
		$this->load->view('Footer');
	}
	
	function login_user()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == TRUE)
		{
			$identity = $_POST['email'];
			$password = $_POST['password'];
			$remember = false; // remember the user
			if($this->ion_auth->login($identity, $password, $remember))
				redirect(base_url());
			
			else
				redirect('login/1');
		}
		else
			$this->login();
	}
	
	function logout()
	{
		if($this->ion_auth->logout())
			redirect('login/2');
	}
	
	
	
	public function fetch_page($identifier)
	{
		$this->db->where('identifier',$identifier);
		$content = $this->db->get('lakeland_pages');
		return $content->row();
	}

	
	
	private function randomAlphaNum($length){ 

		/*$rangeMin = pow(36, $length-1); //smallest number to give length digits in base 36 
		$rangeMax = pow(36, $length)-1; //largest number to give length digits in base 36 
		$base10Rand = mt_rand($rangeMin, $rangeMax); //get the random number 
		$newRand = base_convert($base10Rand, 10, 36); //convert it 
		
		return $newRand; //spit it out */
		
		$arr = str_split('ABCDEFGHJKMNPQRSTUVWXYZ23456789'); // get all the characters into an array
		shuffle($arr); // randomize the array
		$arr = array_slice($arr, 0, $length); // get the first six (random) characters out
		return implode('', $arr); // smush them back into a string

	} 
	
	// public function contact($item='',$id=0)

	// {
	
	
		// $word = strtoupper($this->randomAlphaNum(7));
		
		
		// $this->load->helper('captcha');
		// $vals = array(
		// 'word' => $word,
		// 'img_path'	 => './captcha/',
		// 'img_url'	 => 'captcha/',
		// 'font_path'	 => './captcha/fonts/arial.ttf',
		// 'img_width'	 => '200',
		// 'img_height' => 50,
		// );
		
		// $data['cap'] = create_captcha($vals);
	
		// $cap_data = array(
		// 'captcha_time'	=> $data['cap']['time'],
		// 'ip_address'	=> $this->input->ip_address(),
		// 'word'	 => $data['cap']['word']
		// );
		
		// $query = $this->db->insert_string('lakeland_captcha', $cap_data);	
		// $this->db->query($query);
		
		// $header['projects'] = $this->get_projects(1);
		// $header['publications'] = $this->get_projects(2);
		
		// switch($item)
		// {
		// 	case 'activity':
				
		// 		$this->db->where('id',$id);
		// 		$activities = $this->db->get('lakeland_activities');
		// 		$activity = $activities->row();
									
		// 		if($activity->contact_intro != '')
		// 			$data['contact_intro'] = $activity->contact_intro;
		// 		else
		// 			$data['details'] = $this->fetch_page('CONTACT');
				
		// 		$data['details']->title = $header['title'] = $activity->title;
		// 		$data['subject'] = $activity->link_text;
		// 	break;
			
		// 	default:
				
		// 		$data['details'] = $this->fetch_page('CONTACT');
		// 		$data['title'] = $header['title'] = $data['details']->title;
		// 	break;
		// }
		//$data['details'] = $this->fetch_page('CONTACT');
		//$data['title'] = $header['title'] = $data['details']->title;
	// 	$this->load->view('Header',$header);
	// 	$this->load->view('Contact',$data);
	// 	$this->load->view('Footer');
	// }
	
	function validate_captcha($captcha)
	{
		$expiration = time()-7200; // Two hour limit
		$this->db->query("DELETE FROM lakeland_captcha WHERE captcha_time < ".$expiration);	

	
		// Then see if a captcha exists:
		$sql = "SELECT COUNT(*) AS count FROM lakeland_captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
		$binds = array($captcha, $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		
		
		if($row->count == 0){		// validate??
			$this->form_validation->set_message('validate_captcha', 'You Entered Incorrect Captcha');
			return FALSE;
		}else{
			return TRUE;
		}
		
	}
	
	function send_message()
	{
		if(isset($_POST))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			$this->form_validation->set_rules('message', 'The Message', 'required');
			$this->form_validation->set_rules('captcha', 'The Captcha', 'required|callback_validate_captcha');
			
			$this->form_validation->set_error_delimiters('<li>','</li>');
			
			if ($this->form_validation->run() == TRUE)
			{	
				
				$this->db->where('id',1);
				$obj = $this->db->get('lakeland_settings');
				$email = $obj->row()->value;
				
				
				$this->db->where('setting','CCEMAIL');
				$ccemails = $this->db->get('lakeland_settings');
				
				//echo "Not Configured";
				$this->load->library('email');
				
				$config['protocol'] = 'mail';
				$config['smtp_host'] = 'auth.smtp.1and1.com';
				$config['smtp_user'] = 'info@nipefagio.com';
				$config['smtp_pass'] = 'nipefagio123';
				$config['smtp_port'] = '25';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$config['charset']='utf-8';  
				$config['newline']="\r\n";  

				$this->email->initialize($config);

				$this->email->from('info@nipefagio.com', 'NipeFagio');
				$this->email->bcc('terence@zoomtanzania.com'); 
				
				$this->email->to($email); 
				
				foreach($ccemails->result() as $ccemail)
				{
					$this->email->cc($ccemail->value); 
				}
				
				
				$this->email->subject($_POST['subject']);
				$message = '<html><head></head><body>';
				$message .= 'Name: ' . $_POST['name'] . '<br><br>';
				$message .= 'E-mail: ' . $_POST['email'] . '<br><br>';
				if(isset($_POST['phone']))
					$message .= 'Phone: ' . $_POST['phone'] . '<br><br>';
				$message .= 'Subject: ' . $_POST['subject'] . '<br><br>';
				$message .= 'Message: '. $_POST['message'] . '<br><br>';
				$message .= '</body></html>';	
				$this->email->message($message);	

				if($this->email->send())
				{
					
					
					$this->db->where('identifier','MESSAGE_SENT');
					$details = $this->db->get('lakeland_pages');
					
					$header['projects'] = $this->get_projects(1);
					$header['publications'] = $this->get_projects(2);	
					$data['details'] = $details->row();
					$header['title'] = $details->row()->title;
					$this->load->view('Header',$header);
					$this->load->view('Page',$data);
					$this->load->view('Footer');
				}
				else
					$this->contact(2);
				
			}
			
			else
				$this->contact(2);
		}
		
		else
			redirect('contact/3');
	}
	
	function photos()
	{
		$this->db->where('url','photo-albums');
		$content = $this->db->get('lakeland_pages');
		
		$data['albums'] = $this->db->get('lakeland_photo_albums');
		
		$data['details'] =  $content->row();
		$header['title'] = $data['details']->title;
		$header['description'] = strip_tags( preg_replace("/&#?[a-z0-9]{2,8};/i","",$data['details']->content));
		$menu['menu'] = $this->menu();
		$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#" class="active">' . $data['details']->title . '</a></li>';
		$sidebar['trips'] = $this->sidebar();
		$this->load->view('header',$header);
		$this->load->view('menu',$menu);
		$this->load->view('sidebar',$sidebar);
		$this->load->view('albums',$data);
		$this->load->view('footer');
	}
	
	function album($url)
	{
		
		$this->db->where('url',$url);
		
		$data['album'] = $this->db->get('lakeland_photo_albums');
		
		$this->db->where('album',$data['album']->row()->id);
		$data['pictures'] = $this->db->get('lakeland_album_images');
		

		$header['title'] =  $data['title'] = $data['album']->row()->title;

		$menu['menu'] = $this->menu();
		$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href = "photo-albums">Photo Albums</a></li><li><a href="#" class="active">' . $data['album']->row()->title . '</a></li>';
		$sidebar['trips'] = $this->sidebar();
		$this->load->view('header',$header);
		$this->load->view('menu',$menu);
		$this->load->view('sidebar',$sidebar);
		$this->load->view('album',$data);
		$this->load->view('footer');
	}
	

	

	
	/*function register_test()
	{
		$username = 'mandy.fuller@gmail.com';
		$email = 'mandy.fuller@gmail.com';
		$password = 'nIp3F@giO';
		$additional_data = array(
			'first_name' => 'Mandy',
		);								
//		$group = array('1'); // Sets user to admin. No need for array('1', '2') as user is always set to member by default

		$id = $this->ion_auth->register($username, $password, $email, $additional_data);
		echo($id);		
		
		$username = 'tania@nabaki.com';
		$email = 'tania@nabaki.com';
		$password = 'nIp3F@giO';
		$additional_data = array(
			'first_name' => 'Tania',
		);								
//		$group = array('1'); // Sets user to admin. No need for array('1', '2') as user is always set to member by default

		$id = $this->ion_auth->register($username, $password, $email, $additional_data);
		echo($id);
		
		
		$username = 'sassgroup@gmail.com';
		$email = 'sassgroup@gmail.com';
		$password = 'nIp3F@giO';
		$additional_data = array(
			'first_name' => 'Said',
		);								
//		$group = array('1'); // Sets user to admin. No need for array('1', '2') as user is always set to member by default

		$id = $this->ion_auth->register($username, $password, $email, $additional_data);
		echo($id);		
		
		$username = 'joshpalfreman@yahoo.com';
		$email = 'joshpalfreman@yahoo.com';
		$password = 'nIp3F@giO';
		$additional_data = array(
			'first_name' => 'Josh',
		);								
//		$group = array('1'); // Sets user to admin. No need for array('1', '2') as user is always set to member by default

		$id = $this->ion_auth->register($username, $password, $email, $additional_data);
		echo($id);	
		
		$username = 'caroline.eric@giz.de';
		$email = 'caroline.eric@giz.de';
		$password = 'nIp3F@giO';
		$additional_data = array(
			'first_name' => 'Caroline',
		);								
//		$group = array('1'); // Sets user to admin. No need for array('1', '2') as user is always set to member by default

		$id = $this->ion_auth->register($username, $password, $email, $additional_data);
		echo($id);
	}*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */