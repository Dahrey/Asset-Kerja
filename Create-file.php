
    public function file()
    {

        $data['title'] = 'Data Audio MP3';
        $data['user'] =  $this->db->get_where('user', ['email' =>
        $this->session->userdata('email')])->row_array();

        $data['file'] =  $this->db->get('file')->result_array();

        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar', $data);
            $this->load->view('template/topbar', $data);
            $this->load->view('admin/file', $data);
            $this->load->view('template/footer');
        } else {
            $file        = $_FILES['file'];
            $nama     = $this->input->post('nama');
            $deskripsi     = $this->input->post('deskripsi');
            $tgl           = date('Y-m-d');

            if ($file = '') {
            } else {
                $config['upload_path'] = './files/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']  = '8888';
                $config['remove_space'] = TRUE;

                $this->load->library('upload', $config); // Load konfigurasi uploadnya
                if (!$this->upload->do_upload('file')) {
                    echo "File gagal di Tambahkan!";
                    die();
                } else {
                    $file = $this->upload->data('file_name');
                }
            }

            $data = [
                'file' => $file,
                'nama' => $nama,
                'deskripsi' => $deskripsi,
                'tanggal'  => $tgl
            ];

            $this->db->insert('file', $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            File baru berhasil ditambahkan :)
          </div>');
            redirect('admin/file');
        }
    }

