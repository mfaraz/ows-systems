<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
 * Manipulation on reports management
 *
 * @author manmath
 */
class Reports extends HD_Controller {

	public function __construct() {
		parent::__construct();
		$this->_data['title'] = 'Reports Management';
		$this->load->model(array('mreports', 'mcategories'));
		$this->mreports->mis_report();
        //@ Visal
        $this->load->helper('csv');
        $this->load->library("PHPExcel");
        //-------
	}

	/**
	 * List all reports by current date
	 */
	public function index() {
		$this->form_validation->set_rules('date', '', 'trim|max_length[10]');
		$this->form_validation->set_rules('type', '', 'trim');
		$this->form_validation->set_rules('cashier', '', 'trim');
		$this->form_validation->set_rules('category', '', 'trim');
		$this->form_validation->set_rules('brand', '', 'trim');
		$this->form_validation->set_select('type');
		$this->form_validation->set_select('cashier');
		$this->form_validation->set_select('category');
		$this->form_validation->set_select('brand');
		$this->form_validation->run();
		$per_page = (int) $this->msettings->display_setting('DEFAULT_PAGINATION');
		//$this->_data['reports'] = $this->mreports->findAllReports($per_page, $this->uri->segment(3));
        //@Visal
        $query = $this->mreports->findAllReports($per_page, $this->uri->segment(3));
        //------
        $this->_data['reports'] = $query;
        //@Visal
        if ($this->input->post('export')) {
            $phpExcel = new PHPExcel();
            $prestasi = $phpExcel->setActiveSheetIndex(0);
            //merger
            $phpExcel->getActiveSheet()->mergeCells('A1:C1');
            //manage row hight
            $phpExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(25);
            //style alignment
            $styleArray = array(
                'alignment' => array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                ),
            );
            $phpExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
            $phpExcel->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleArray);
            //border
            $styleArray1 = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            //background
            $styleArray12 = array(
                'fill' => array(
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'startcolor' => array(
                        'rgb' => 'FFEC8B',
                    ),
                ),
            );
            //freeepane
            $phpExcel->getActiveSheet()->freezePane('A3');
            //coloum width
            $phpExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4.1);
            $phpExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $phpExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
            $phpExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $phpExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $phpExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $phpExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $phpExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $phpExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $phpExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
            $prestasi->setCellValue('A1', 'Report Management');
            $phpExcel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($styleArray);
            $phpExcel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($styleArray1);
            $phpExcel->getActiveSheet()->getStyle('A2:J2')->applyFromArray($styleArray12);
            $prestasi->setCellValue('A2', 'No');
            $prestasi->setCellValue('B2', 'Invoice Number');
            $prestasi->setCellValue('C2', 'Customer');
            $prestasi->setCellValue('D2', 'Invoice Date');
            $prestasi->setCellValue('E2', 'Cashier');
            $prestasi->setCellValue('F2', 'Brand');
            $prestasi->setCellValue('G2', 'Product');
            $prestasi->setCellValue('H2', 'Quantity');
            $prestasi->setCellValue('I2', 'Unit Price');
            $prestasi->setCellValue('J2', 'Total');
            $data = $query;
            if ($data) {
                $no = 0;
                $rowexcel = 2;
                foreach ($data as $row) {
                    $no++;
                    $rowexcel++;
                    $phpExcel->getActiveSheet()->getStyle('A' . $rowexcel . ':J' . $rowexcel)->applyFromArray($styleArray);
                    $phpExcel->getActiveSheet()->getStyle('A' . $rowexcel . ':J' . $rowexcel)->applyFromArray($styleArray1);
                    $phpExcel->getActiveSheet()->getStyle('B' . $rowexcel)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    $prestasi->setCellValue('A' . $rowexcel, $no);
                    $prestasi->setCellValue('B' . $rowexcel, $row->invoice_number.' ');
                    $prestasi->setCellValue('C' . $rowexcel, $row->customer);
                    $prestasi->setCellValue('D' . $rowexcel, $row->invoice_date);
                    $prestasi->setCellValue('E' . $rowexcel, $row->invoice_seller);
                    $prestasi->setCellValue('F' . $rowexcel, $row->category_name);
                    $prestasi->setCellValue('G' . $rowexcel, $row->product_name);
                    $prestasi->setCellValue('H' . $rowexcel, $row->product_qty);
                    $prestasi->setCellValue('I' . $rowexcel, '$'.$row->product_price);
                    $prestasi->setCellValue('J' . $rowexcel, '$'.$row->product_total);
                }
                $prestasi->setTitle('Invoice Management Report');
                header("Content-Type: application/vnd.ms-excel");
                header("Content-Disposition: attachment; filename=\"Invoice Management Report.xls\"");
                header("Cache-Control: max-age=0");
                $objWriter = PHPExcel_IOFactory::createWriter($phpExcel, "Excel5");
                $objWriter->save("php://output");
            }
        }
        //-------
		$this->_data['cashiers'] = $this->musers->select_cashier();
		$this->_data['categories'] = $this->mcategories->select_categorylist();
		$this->_data['brands'] = $this->mcategories->select_brandlist();
		page_browser(base_url() . 'reports/index/', (int) $this->mreports->countAllReports(), $per_page);
		$this->load->view('index', $this->_data);
	}

}

/* End of file reports.php */
/* Location: ./application/controllers/reports.php */
