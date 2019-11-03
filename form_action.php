<?php

    include('database_connection.php');
    $form_data = json_decode(file_get_contents("php://input"));
    $error              = '';
    $message            = '';
    $validation_error   = '';
    $nip                = '';
    $nama_pegawai       = '';
    $alamat             = '';

    if($form_data->action == 'fetch_single_data'){
        $query = "SELECT * FROM pegawai WHERE pegawai_id='".$form_data->pegawai_id."'";
        $statement = $connect->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        foreach($result as $row){
            $output['nip']          = $row['nip'];
            $output['nama_pegawai'] = $row['nama_pegawai'];
            $output['alamat']       = $row['alamat'];
        }
    }elseif($form_data->action == "Delete"){
        $query = "DELETE FROM pegawai WHERE pegawai_id='".$form_data->pegawai_id."'";
        $statement = $connect->prepare($query);
        if($statement->execute()){
            $output['message'] = 'Data Deleted';
        }
    }else{
        if(empty($form_data->nip)){
            $error[] = 'NIP is Required';
        }else{
            $nip = $form_data->nip;
        }

        if(empty($form_data->nama_pegawai)){
            $error[] = 'Nama Pegawai is Required';
        }else{
            $nama_pegawai = $form_data->nama_pegawai;
        }

        if(empty($form_data->alamat)){
            $error[] = 'Alamat is Required';
        }else{
            $alamat = $form_data->alamat;
        }

        if(empty($error)){
            if($form_data->action == 'Insert'){
                $data = array(
                    ':nip'		=> $nip,
                    ':nama_pegawai'	=> $nama_pegawai,
                    ':alamat'		=> $alamat
                );
                $query = "INSERT INTO pegawai 
                    (nip, nama_pegawai, alamat) VALUES 
                    (:nip, :nama_pegawai, :alamat)
                ";
                $statement = $connect->prepare($query);
                if($statement->execute($data)){
                    $message = 'Data Inserted';
                }
            }
            if($form_data->action == 'Edit'){
                $data = array(
                    ':nip'              => $nip,
                    ':nama_pegawai'	=> $nama_pegawai,
                    ':alamat'           => $alamat,
                    ':pegawai_id'	=> $form_data->pegawai_id
                );
                $query = "UPDATE pegawai 
                    SET nip = :nip, nama_pegawai = :nama_pegawai , alamat = :alamat
                    WHERE pegawai_id = :pegawai_id
                ";

                $statement = $connect->prepare($query);
                if($statement->execute($data)){
                    $message = 'Data Edited';
                }
            }
        }else{
            $validation_error = implode(", ", $error);
        }

        $output = array(
            'error'	=> $validation_error,
            'message'	=> $message
        );

    }

    echo json_encode($output);

?>