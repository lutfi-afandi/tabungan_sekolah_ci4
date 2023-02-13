<?php

namespace App\Controllers;

use App\Models\ModelAuth;
use App\Models\ModelKelas;
use App\Models\ModelLaporan;
use App\Models\ModelPetugas;
use App\Models\ModelSetting;
use App\Models\ModelSiswa;
use App\Models\ModelTabungan;
use App\Models\ModelTransaksi;
use App\Models\ModelUser;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        session();
        helper('swal_helper');
        $this->getErrors = \Config\Services::validation()->getErrors();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->kelas = new ModelKelas();
        $this->user = new ModelUser();
        $this->auth = new ModelAuth();
        $this->petugas = new ModelPetugas();
        $this->setting = new ModelSetting();
        $this->siswa = new ModelSiswa();
        $this->transaksi = new ModelTransaksi();
        $this->tabungan = new ModelTabungan();
        $this->laporan = new ModelLaporan();
    }
}