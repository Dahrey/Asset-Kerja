
    public function deleteAudio()
    {
        $id = $this->input->get('id');
        $g =  $this->db->get_where('audio', ['id' => $id])->row_array();
        //hapus gambar di path
        unlink("./audio/" . $g['audio']);
        $this->db->delete('audio', array('id' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Audio Mp3 berhasil dihapus
          </div>');
        redirect('admin/audio');
    }
