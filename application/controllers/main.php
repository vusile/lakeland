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
		
		$query = "select saf.title, saf.url, sch.start_date, sch.end_date from lakeland_safaris saf, lakeland_scheduled_trips sch where saf.id = sch.trip and start_date > '" . date('Y-m-d') . "' order by start_date";

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
		$menu = '';
		$this->db->order_by('priority');
		$this->db->where('parent_page', 0);
		$pages=$this->db->get('lakeland_pages');

		foreach($pages->result() as $page)
		{
			if($page->draws_from != 0)
			{
				$menu .= "<li><a href = '" . current_url() . "'>"  . $page->title .  "</a><ul class='subnav'>";
				$this->db->where('id',$page->draws_from);
				$draws = $this->db->get('lakeland_draws_from');
				$draw = $draws->row()->type;

				$this->db->where('parent_category',0);
				$this->db->where('type',$draw);
				$categories = $this->db->get('lakeland_page_categories');

				foreach($categories->result() as $category)
				{
					if($category->type == 1)
						$preurl = 'safaris';
					else $preurl = 'destinations';

					$this->db->where('parent_category',$category->id);
					$cats = $this->db->get('lakeland_page_categories');

					if($cats->num_rows() == 0)
						$menu .= "<li><a href = '" . $preurl . '/' . $category->url . "'>"  . $category->title .  "</a></li>";

					else {
						$menu .= "<li><a href = '" . current_url() . "'>"  . $category->title .  "</a><ul class='subnav'>";
						
						foreach($cats->result() as $cat)
						{
							$menu .= "<li><a href = '" . $preurl . '/' . $cat->url . "'>"  . $cat->title .  "</a></li>";
						}

						$menu .= '</ul></li>';
					}
					
				}

				$menu .= '</ul></li>';

			}
			else
			{
				$this->db->where('parent_page', $page->id);
				$kids = $this->db->get('lakeland_pages');
				if($kids->num_rows() == 0)
					$menu .= "<li><a href = '" . $page->url . "'>"  . $page->title .  "</a></li>";
				else
				{
					$menu .= "<li><a href = '" . current_url() . "'>"  . $page->title .  "</a><ul class='subnav'>";		
					foreach($kids->result() as $kid)
					{
						$menu .= "<li><a href = '" . $page->url . '/' . $kid->url . "'>"  . $kid->title .  "</a></li>";
					}
					$menu .= '</ul></li>';		
				}

			}

		}

		return $menu;
	}
	 
	function test()
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
		if($data['details']->browser_title != '')
			$header['title'] = $data['details']->browser_title;
		else
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

		if($content->num_rows() == 0)
		{
			$this->db->where('url','about-us');
			$content = $this->db->get('lakeland_pages');
		}


		$data['details'] =  $content->row();
		$header['title'] = $data['details']->browser_title . ' in Tanzania';
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
		$header['title'] = $data['details']->title . ' in Tanzania';
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
		$header['title'] = $data['details']->title . ' in Tanzania';
		//$header['description'] = strip_tags( preg_replace("/&#?[a-z0-9]{2,8};/i","",$data['details']->content));
		
		$menu['menu'] = $this->menu();
		$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Car Rentals</a></li><li><a href="#" class="active">' . $data['details']->title . '</a></li>';
		$data['button']=   '<div class="inquiry"><a href="contact" class="inquiry-button">Inquire About ' . $data['details']->title . ' </a></div><br>';
		$sidebar['trips'] = $this->sidebar();
		$this->load->view('header',$header);
		$this->load->view('menu',$menu);
		$this->load->view('sidebar',$sidebar);
		$this->load->view('day_tours_details',$data);
		//ADD CAR RENTALS CONTACT FORM HERE.
		$this->load->view('footer');
	}
	
	public function destinations($url)
	{
		//$this->db->where('url',$url);
	//	$content = $this->db->get('lakeland_pages');
	
		$this->db->where('url', $url);
		$category = $this->db->get('lakeland_page_categories');
		$cat = $category->row();

		$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Destinations</a></li><li><a href="#" class="active">'. $cat->title .'</a></li>';

			
		
		$this->db->where('destination_type',$cat->id);
		$this->db->select('*, destination_name as title, destination_description as introductory_text');
		$data['trips'] = $this->db->get('lakeland_destinations');

		

		$data['details'] =  $cat;
		$header['title'] = $cat->title . ' in Tanzania';
		$header['description'] = strip_tags( preg_replace("/&#?[a-z0-9]{2,8};/i","",$cat->intro_text));
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
		$contents = $this->db->get('lakeland_page_categories');
		$content = $contents->row();
		switch($content->template)
		{
			case 'safari':
				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="#">Overland Safaris</a></li><li><a href="#" class="active">'. $content->title .'</a></li>';
				$this->db->where('type',$content->id);
				$this->db->where('safari_type',$content->safari_type);
				$data['trips'] = $this->db->get('lakeland_safaris');


				if($data['trips']->num_rows() == 0 and $content->safari_type != 1)
				{
					$this->db->where('safari_type',$content->safari_type);
					$data['trips'] = $this->db->get('lakeland_safaris');
					$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="#" class="active">'. $content->title .'</a></li>';
				}
				
				
			break;
			
			
			case 'custom':
				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="#" class="active">Custom Packages</a></li>';
				$beaches = array();
				$cultural = array();
				$parks = array();
				
				$custom = 1;
				$this->db->order_by('destination_type');
				$destinations = $this->db->get('lakeland_destinations');
				
				foreach($destinations->result() as $destination)
				{
					if($destination->destination_type == 10)
						$parks[$destination->url] = $destination->destination_name;
					else if($destination->destination_type == 11)
						$beaches[$destination->url] = $destination->destination_name;
					else if($destination->destination_type == 12)
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
			
			case 'schedule':
				$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#">Group Overland Safaris</a></li><li><a href="#" class="active">Scheduled Trips</a></li>';
				$data['schedule'] = $this->schedule();
				$scheduled = 1;
			break;
			
		}
		
		$sidebar['trips'] = $this->sidebar();
		$data['details'] =  $content;
		$header['title'] = $content->title . ' in Tanzania';
		$header['description'] = strip_tags( preg_replace("/&#?[a-z0-9]{2,8};/i","",$content->intro_text));
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
		$header['title'] = $data['safari']->title . ' in Tanzania';
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
		$header['title'] = $data['safari']->destination_name . ' in Tanzania';
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
		$this->load->view('header',$header);
		$this->load->view('menu',$menu);
		$this->load->view('sidebar',$sidebar);
		$this->load->view('Login');
		$this->load->view('footer');
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
	
	function send_message($form=1)
	{
		if(isset($_POST))
		{
			$this->load->library('form_validation');
			$this->form_validation->set_rules('name', 'Name', 'required');
			$this->form_validation->set_rules('subject', 'Subject', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('interests', 'Your interests', 'required');
			$this->form_validation->set_rules('captcha', 'The Captcha', 'required|callback_validate_captcha');
			
			$this->form_validation->set_error_delimiters('<p style = "color: red; font-weight: bold;">','</p>');
			
			if ($this->form_validation->run() == TRUE)
			{	
				

				
				//echo "Not Configured";
				$this->load->library('email');
				
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'mail.lakelandafrica.com';
				$config['smtp_user'] = 'reservations@lakelandafrica.com';
				$config['smtp_pass'] = '1919wisiko';
				$config['smtp_port'] = '25';
				$config['mailtype'] = 'html';
				$config['wordwrap'] = TRUE;
				$config['charset']='utf-8';  
				$config['newline']="\r\n";  

				$this->email->initialize($config);

				$this->email->from('reservations@lakelandafrica.com', 'Lakeland Africa');
				$this->email->bcc('terence@zoomtanzania.com'); 
				
				$this->email->to('reservations@lakelandafrica.com'); 
				

				
				$this->email->subject($_POST['subject']);
				$message = '<html><head></head><body>';

				foreach($_POST as $key=>$value)
				{
					if($key == 'subject' or $key == 'captcha' or $key == 'confirm_email')
						$message .= "";
					else
					{
						if($value != '')
							$message .= '<strong>' . ucwords(str_replace("_", " ", $key)) .'</strong>: '. $value . '<br>';
					}
				}


				$message .= '</body></html>';	
				$this->email->message($message);	
				$this->email->set_alt_message($message);

				if($this->email->send())
				{

					$header['title'] = 'Message Sent';

					$menu['menu'] = $this->menu();
					$menu['crumbs'] = '<li><a href = "home">Home</a></li><li><a href="#" class="active">Message Sent</a></li>';
					$sidebar['trips'] = $this->sidebar();
					$data['details']->title = "Message Sent";
					$data['details']->content = "<p>Your Message has been sent to us, please give us a while to respond.</p>";
					$this->load->view('header',$header);
					$this->load->view('menu',$menu);
					$this->load->view('sidebar',$sidebar);
					$this->load->view('day_tours_details',$data);
					$this->load->view('footer');
				}
				else
				{
					if($form==1)
						$this->contact(2);
					else
						$this->safaris('custom-packages');
				}

			}
			
			else
			{
				if($form==1)
					$this->contact(2);
				else $this->safaris('custom-packages');
			}
		}
		
		else
		{
			if($form==1)
				redirect('contact/3');
			else
				$this->redirect('safaris/custom-packages');
			
		}
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
	
	function xml_sitemap()
	{
		$this->load->helper('file');
		$this->db->where('draws_from', 0);
		$this->db->where('parent_page', 0);
		$pages = $this->db->get('lakeland_pages');



		
		$xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
		
		



		$xml .= '<url><loc>' . base_url() . '</loc><lastmod>' . date('Y-m-d') . '</lastmod><changefreq>monthly</changefreq><priority>1</priority></url>';

		foreach ($pages->result() as $page) {
			if($page->url == 'home')
				$xml .= '';
			else
			{	

				$this->db->where('parent_page',$page->id);
				$subs=$this->db->get('lakeland_pages');
				if($subs->num_rows() > 0)
				{
					foreach ($subs->result() as $sub) {
						
						$xml .= '<url><loc>' . base_url()  . $page->url . '/' . $sub->url . '</loc><lastmod>' . date('Y-m-d') . '</lastmod><changefreq>monthly</changefreq><priority>.7</priority></url>';
					}
				}

				else

				$xml .= '<url><loc>' . base_url()  . $page->url . '</loc><lastmod>' . date('Y-m-d') . '</lastmod><changefreq>monthly</changefreq><priority>.7</priority></url>';
			}
		}

		$this->db->where('type', 1);
		$this->db->where('safari_type <>', 0);
		$cats=$this->db->get('lakeland_page_categories');

		foreach($cats->result() as $cat)
		{

			if($cat->url =='custom-packages' or $cat->url =='scheduled-trips')
				$xml .= '<url><loc>' . base_url()  . 'safaris/' . $cat->url . '</loc><lastmod>' . date('Y-m-d') . '</lastmod><changefreq>monthly</changefreq><priority>1</priority></url>';
			else
			{
				$this->db->where('safari_type', $cat->safari_type);

				if($cat->parent_category==3)
					$this->db->where('type', $cat->id);		

				$safaris=$this->db->get('lakeland_safaris');

				if($safaris->num_rows()>0)
				{
					foreach($safaris->result() as $safari)
					{
						$xml .= '<url><loc>' . base_url()  . 'trip/' . $safari->url . '</loc><lastmod>' . date('Y-m-d') . '</lastmod><changefreq>monthly</changefreq><priority>1</priority></url>';
					}
				}

			}
		}

		$this->db->where('type', 2);
		$cats=$this->db->get('lakeland_page_categories');

		foreach($cats->result() as $cat)
		{


			$this->db->where('destination_type', $cat->id);
			$destinations=$this->db->get('lakeland_destinations');

			if($destinations->num_rows()>0)
			{
				foreach($destinations->result() as $destination)
				{
					$xml .= '<url><loc>' . base_url()  . 'destination/' . $destination->url . '</loc><lastmod>' . date('Y-m-d') . '</lastmod><changefreq>monthly</changefreq><priority>1</priority></url>';
				}
			}

			
		}

		$xml .= '</urlset>';
		
		if ( ! write_file('sitemap.xml', $xml))
		{
			 echo 'Unable to write the xml file';
		}
		else
		{
			echo 'xml Sitemap was updated';
			$this->pingGoogleSitemaps('http://www.lakelandafrica.com/sitemap.xml');
		}
	}
	
	function pingGoogleSitemaps( $url_xml )
	{
	   $status = 0;
	   $google = 'www.google.com';
	   if( $fp=@fsockopen($google, 80) )
	   {
		  $req =  'GET /webmasters/sitemaps/ping?sitemap=' .
				  urlencode( $url_xml ) . " HTTP/1.1\r\n" .
				  "Host: $google\r\n" .
				  "User-Agent: Mozilla/5.0 (compatible; " .
				  PHP_OS . ") PHP/" . PHP_VERSION . "\r\n" .
				  "Connection: Close\r\n\r\n";
		  fwrite( $fp, $req );
		  while( !feof($fp) )
		  {
			 if( @preg_match('~^HTTP/\d\.\d (\d+)~i', fgets($fp, 128), $m) )
			 {
				$status = intval( $m[1] );
				break;
			 }
		  }
		  fclose( $fp );
	   }
	   //return( $status );
	   echo $status;
	}
	

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */