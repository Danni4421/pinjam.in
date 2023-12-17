<?php 
class AddPeminjamanRequest extends Request {
  public function request(array $payload) 
  {
    $peminjamanRepository = new PeminjamanRepository(new MySQL());
    $userRepository = new UserRepository(new MySQL());
    $peminjamanUseCase = new PeminjamanUseCase(
      peminjamanRepository: $peminjamanRepository,
      userRepository: $userRepository
    );

    $baseUrl = "assets/dist/images/uploads/peminjaman/logo/";
    if (isset($_FILES["payload"])) {
      $baseUrl .= time() . $_FILES["payload"]["name"]["logo"];
      move_uploaded_file($_FILES["payload"]["tmp_name"]["logo"], $baseUrl);
    } else {
      $baseUrl = null;
    }

    $peminjamanUseCase->addPeminjaman($payload);

    return [
      "status" => "success",
      "data" => []
    ];
  }
}
?>