<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Invoices extends HD_Controller {

	public function __construct() {
		parent::__construct();
		$this->_data['title'] = 'Invoice Management';
		$this->load->model(array('minvoices', 'msales', 'mdeposits'));
        //@ Visal
        $this->load->helper('csv');
        $this->load->library("PHPExcel");
        //-------
	}

	/**
	 * List view
	 *
	 * @param int $page
	 */
	public function index($page = 1) {
		$this->form_validation->set_rules('invoice_number', '', 'trim');
		$this->form_validation->set_rules('customer', '', 'trim');
		$this->form_validation->run();
		$per_page = (int) $this->msettings->display_setting('DEFAULT_PAGINATION');
		
        $query = $this->minvoices->findAllInvoices($per_page, $this->uri->segment(3));
        $this->_data['invoices'] = $query;
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
            $phpExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
            $phpExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
            $prestasi->setCellValue('A1', 'Invoice Management');
            $phpExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($styleArray);
            $phpExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($styleArray1);
            $phpExcel->getActiveSheet()->getStyle('A2:I2')->applyFromArray($styleArray12);
            $prestasi->setCellValue('A2', 'No');
            $prestasi->setCellValue('B2', 'Invoice No');
            $prestasi->setCellValue('C2', 'Cashier');
            $prestasi->setCellValue('D2', 'Customer');
            $prestasi->setCellValue('E2', 'Total');
            $prestasi->setCellValue('F2', 'Deposit');
            $prestasi->setCellValue('G2', 'Remaining');
            $prestasi->setCellValue('H2', 'Invoice or Deposit Date');
            $prestasi->setCellValue('I2', 'Complete Payment Date');
            $data = $query;
            if ($data) {
                $no = 0;
                $rowexcel = 2;
                foreach ($data->result() as $row) {
                    $no++;
                    $rowexcel++;
                    $phpExcel->getActiveSheet()->getStyle('A' . $rowexcel . ':I' . $rowexcel)->applyFromArray($styleArray);
                    $phpExcel->getActiveSheet()->getStyle('A' . $rowexcel . ':I' . $rowexcel)->applyFromArray($styleArray1);
                    $phpExcel->getActiveSheet()->getStyle('B' . $rowexcel)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
                    $prestasi->setCellValue('A' . $rowexcel, $no);
                    $prestasi->setCellValue('B' . $rowexcel, $row->invoice_number.' ');
                    $prestasi->setCellValue('C' . $rowexcel, $row->cashier);
                    $prestasi->setCellValue('D' . $rowexcel, $row->customer);
                    $prestasi->setCellValue('E' . $rowexcel, $row->cash_type == 'US' ? '$'.$row->grand_total : $row->grand_total.'៛' );
                    if($row->deposit != '0.00'){
                        $prestasi->setCellValue('F' . $rowexcel, $row->cash_type == 'US' ? '$'.$row->deposit : $row->deposit.'៛');
                    }else{
                        $prestasi->setCellValue('F' . $rowexcel, '---');
                    }
                    if($row->balance != '0.00'){
                        $prestasi->setCellValue('G' . $rowexcel, $row->cash_type == 'US' ? '$'.$row->balance : $row->balance.'៛');
                    }else{
                        $prestasi->setCellValue('G' . $rowexcel, '---');
                    }
                    $prestasi->setCellValue('H' . $rowexcel, mdate('%d-%M-%Y %H:%i', $row->crdate));
                    $prestasi->setCellValue('I' . $rowexcel, $row->modate != 0 ? mdate('%d-%M-%Y %H:%i', $row->modate) : '---');
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
		$this->_data['total_invoices'] = $this->minvoices->countAllInvoices();
		$this->_data['total_deposits'] = $this->minvoices->countAllInvoicesDeposit();
		page_browser(base_url() . 'invoices/index/', $this->_data['total_invoices'], $per_page);
		$this->load->view('index', $this->_data);
	}

	/**
	 * Show detail
	 */
	public function view() {
		if ($this->uri->segment(3)) {
			$this->_data['invoices'] = $this->minvoices->view($this->uri->segment(3));
		}
		$this->load->view('index', $this->_data);
	}

	/**
	 * Load invoice preparation for printing
	 */
	public function prepare_invoice() {
		// check in case invoice exist
		$chash = $this->uri->segment(3);
		$this->_data['invoice_items'] = $this->msales->check_purchase($chash);
		
		if($this->input->post('invoice_id') != ''){
			$iid = $this->input->post('invoice_id');
		}else{
			$iid = $this->uri->segment(4);
		}
		if (!$this->session->userdata('cur_invoice_id')) {
			$this->session->set_userdata('cur_invoice_id', $iid);
		}
		$this->_data['sub_total'] = $this->msales->get_total($iid);
		$this->_data['data'] = $this->msales->get_customer($chash);

		$this->form_validation->set_rules('customer', 'Customer', 'trim');
		$this->form_validation->set_rules('cash_receive', 'Cash Received', 'trim|numeric');
		$this->form_validation->set_rules('cash_type', '', 'trim');
		$this->form_validation->set_rules('discount', 'Discount', 'trim|numeric|max_length[3]');
		$this->form_validation->set_rules('deposit', 'Deposit', 'trim|numeric');
		$this->form_validation->set_select('cash_type');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('index', $this->_data);
		} else {
			$cash_receive = $this->input->post('cash_receive');
			$cash_type = $this->input->post('cash_type');
			$total = $this->_data['sub_total'];

			if ($cash_type == 'KH') {
				$total = $total * $this->msettings->display_setting('DEFAULT_USD_TO_KH');
			}

			// Discount
			if ($this->input->post('discount')) {
				$discount = $this->input->post('discount');
				$grant_total = $total * (1 - $discount / 100);
			} else {
				$discount = 0;
				$grant_total = $total;
			}

			if (empty($cash_receive)) { // do not pay
				$cash_receive = 0.00;
				$deposit = 0;
				$balance = $grant_total;
			} else {
				// Deposit
				if ($this->input->post('deposit')) {
					$deposit = $this->input->post('deposit');
					$modate = 0;
					$balance = $grant_total - $deposit;
					if ($this->input->post('deposit') < $cash_receive) {
						$cash_exchange = $cash_receive - $deposit;
					} else {
						$cash_exchange = 0;
					}
				} else { // complete payment
					$deposit = 0;
					$modate = time();
					$balance = 0;
					if ($cash_receive > $grant_total) {
						$cash_exchange = $cash_receive - $grant_total;
					} else {
						$cash_exchange = 0;
					}
				}
			}
			$customer = ($this->input->post('customer') != '') ? $this->input->post('customer') : 'Normal';
			$data = array(
				'customer' => $customer,
				'total' => $total,
				'cash_receive' => $cash_receive,
				'cash_type' => $cash_type,
				'discount' => $discount,
				'grand_total' => $grant_total,
				'deposit' => $deposit,
				'balance' => $balance,
				'cash_exchange' => $cash_exchange,
				'modate' => $modate
			);

			if ($this->msales->update_invoice($data)) {
				$this->session->set_flashdata('message', alert_message("Invoice is ready for printing!", 'success'));
			}

			redirect('invoices/prepare_invoice/');
		}
	}

	/**
	 * Cut stock after printing invoice
	 */
	public function print_invoice() {
		if ($this->session->userdata('cur_invoice_id')) {
			$result = $this->msales->check_purchase();
			foreach ($result as $item) {
				$this->msales->cut_stock($item->name, $item->qty);
			}
			$this->msales->print_invoice();
			$this->session->unset_userdata('cur_invoice_id');
			$this->session->unset_userdata('returnable');
			$this->session->set_flashdata('message', alert_message("New invoice has been printed and saved!", 'success'));
			redirect('sales/');
		} else {
			$this->mdeposits->clear_deposit($this->uri->segment(3));
			$this->session->set_flashdata('message', alert_message("New invoice has been printed and saved!", 'success'));
			redirect('deposits/');
		}
	}

	/**
	 * Complete payment from deposit
	 */
	public function complete_payment() {
		$invoice_no = $this->uri->segment(3);
		$this->_data['invoice_no'] = $invoice_no;

		//$this->form_validation->set_rules('cash_receive', 'Cash Received', 'required|trim|numeric');
		$this->form_validation->set_rules('cash_receive', 'Cash Received', 'trim|numeric|callback_maximumCheck');
		$this->form_validation->set_rules('cash_type', '', 'trim');
		$this->form_validation->set_select('cash_type');
		if ($this->form_validation->run() == FALSE) {
			$this->msales->clear_invoice_history($invoice_no);
		} else {
			
			$cash_receive = $this->input->post('cash_receive');
			$cash_type = $this->input->post('cash_type');
			$balance = $this->input->post('balance');
			$prev_cash_type = $this->input->post('prev_cash_type');
			if($cash_receive < $balance){
				$this->msales->clear_invoice_history($invoice_no);
				// command
				//$this->session->set_flashdata('message', alert_message("Cash receive must be equal or bigger than remaining balance!", 'error'));
			}else{
				if ($cash_type != $prev_cash_type) {
					switch ($cash_type) {
						case 'US':
							$cash_receive = $cash_receive * USD_TO_KH;
							break;
						default:
							$balance = $balance * USD_TO_KH;
							break;
					}
				}

				if ($cash_receive == $balance) {
					$cash_exchange = 0.00;
				} else {
					$cash_exchange = $cash_receive - $balance;
				}

				$data = array(
					'cash_receive' => $cash_receive,
					'cash_type' => $cash_type,
					'cash_exchange' => $cash_exchange,
					'modate' => time()
				);
				$this->msales->new_invoice_hostory($invoice_no, $data);
			}
		}
		$this->_data['invoice_items'] = $this->msales->check_purchase($invoice_no);
		$this->load->view('index', $this->_data);
	}
	
	function maximumCheck($num)
	{
		$balance = $this->input->post('balance');
		
		if ($num < $balance)
		{
			$this->form_validation->set_message('maximumCheck','%s cannot less than remaining Amount');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

}

/* End of file invoices.php */
/* Location: ./application/controllers/invoices.php */
