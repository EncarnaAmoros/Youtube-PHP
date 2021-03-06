<?php

class subirVideo_m extends CI_Model {

	function get_all_videovisibility() {
		$this->db->select('id, name');
		return $this->db->get("videovisibility")->result();
	}

	function get_all_licenses() {
		$this->db->select('id, name');
		return $this->db->get("license")->result();
	}

	function get_all_categories() {
		$this->db->select('id, name');
		return $this->db->get("category")->result();
	}

	function get_all_languages() {
		$this->db->select('id, name');
		return $this->db->get("language")->result();
	}

	function get_all_qualities() {
		$this->db->select('id, name');
		return $this->db->get("quality")->result();
	}

	function get_all_tags() {
		$this->db->select('name as `id`, name as `text`');
		return $this->db->get("tag")->result();
	}

	function count_all() {
		return $this->db->count_all("user");
	}

	function get_tag_name($name) {
		$this->db->select('id, name');
		$this->db->where('name', $name);
		return $this->db->get("tag")->result();
	}

	function insert_tag($name) {
		$data = array(
			'name'	=> $name
		);
		$this->db->insert('tag',$data);
	}

	function insert_videotag($idvideo, $idtag) {
		$data = array(
			'video'	=> $idvideo,
			'tag'	=> $idtag
		);
		$this->db->insert('videotag',$data);
	}

	function insert_videoquality($idvideo, $idquality) {
		$data = array(
			'video'	=> $idvideo,
			'quality'	=> $idquality
		);
		$this->db->insert('videoquality',$data);
	}

	function nuevo_video($user, $title, $url, $description, $visibility, $license, $category, $language) {
		$data = array(
			'user'	=> $user,
			'title' => $title,
			'url' => $url,
			'description' => $description,
			'visibility' => $visibility,
			'license' => $license,
			'category' => $category,
			'language' => $language
		);

		//Lo insertamos en la BD
		$this->db->insert('video',$data);

		$insert_id = $this->db->insert_id();
		return  $insert_id;

	}
}
