<?php
class Eventmodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->tabel = "events";
        $this->tabelcustomer = "customer";
        $this->tabelcategory = "category";
        $this->tabelpayment = "payments";
    }
    //simpan ke tabel penjualan
    function save($data = null, $payment)
    {
        if (is_null($data)) {
            if ($this->db->insert($this->tabelpayment, $payment)) {
                $msg = "Add payment is successfully added";
                $num = "0";
                $stat = "success";
            }
        } else if ($this->db->insert($this->tabel, $data) && $this->db->insert($this->tabelpayment, $payment)) {
            $msg = "New event is successfully created";
            $num = "0";
            $stat = "success";
        } else {
            $msg = "Data input failed <br> " . $this->db->_error_message();
            $num = $this->db->_error_number();
            $stat = "danger";
        }
        return array($stat, $msg, $num);
    }
    //simpan tabel payment
    function saveDetail($datapayment)
    {
        if ($this->db->insert($this->tabelpayment, $datapayment)) {
            return true;
        } else {
            return false;
        }
    }
    //ambil event berdasarkan eventid
    function getEventById($eventid)
    {
        $this->db->select($this->tabel . '.*,
                         ' . $this->tabelcustomer . '.name,
                         ' . $this->tabelcustomer . '.telp,
                         ' . $this->tabelcategory . '.category,
                         ' . $this->tabelcategory . '.price,
                         sum(' . $this->tabelpayment . '.amount) as payment');
        $this->db->from($this->tabel);
        $this->db->join($this->tabelcustomer, $this->tabelcustomer . '.customerid = ' . $this->tabel . '.customerid');
        $this->db->join($this->tabelcategory, $this->tabelcategory . '.categoryid = ' . $this->tabel . '.categoryid');
        $this->db->join($this->tabelpayment, $this->tabelpayment . '.eventid = ' . $this->tabel . '.eventid');
        $this->db->where($this->tabel . '.eventid=', $eventid);
        $this->db->group_by('eventid');

        $query = $this->db->get();
        $row = $query->result_array();
        return $row;
    }

    //ambil data penjualan semuanya
    function getDataEvent()
    {
        $this->db->select($this->tabel . '.*,
                         ' . $this->tabelcustomer . '.name,
                         ' . $this->tabelcustomer . '.telp,
                         ' . $this->tabelcategory . '.category,
                         ' . $this->tabelcategory . '.price,
                         sum(' . $this->tabelpayment . '.amount) as payment');
        $this->db->from($this->tabel);
        $this->db->join($this->tabelcustomer, $this->tabelcustomer . '.customerid = ' . $this->tabel . '.customerid');
        $this->db->join($this->tabelcategory, $this->tabelcategory . '.categoryid = ' . $this->tabel . '.categoryid');
        $this->db->join($this->tabelpayment, $this->tabelpayment . '.eventid = ' . $this->tabel . '.eventid');
        $this->db->group_by('eventid');
        $this->db->order_by('date', 'asc');

        $query = $this->db->get();
        //die($this->db->last_query());
        $row = $query->result_array();
        return $row;
    }

    //ambil event berdasarkan eventid
    function getPaymentById($eventid)
    {
        $this->db->select('*');
        $this->db->from($this->tabelpayment);
        $this->db->where('eventid=', $eventid);
        $this->db->order_by('date', 'asc');

        $query = $this->db->get();
        //die($this->db->last_query());
        $row = $query->result_array();
        return $row;
    }

    function update($data, $id)
    {
        $this->db->where('eventid', $id);
        if ($this->db->update($this->tabel, $data)) {
            $msg = "Data is updated successfully";
            $num = "0";
            $stat = "success";
        } else {
            $msg = "Data is failed to update <br> " . $this->db->_error_message();
            $num = $this->db->_error_number();
            $stat = "danger";
        }
        return array($stat, $msg, $num);
    }

    function checkdate($date, $eventid = null)
    {
        $this->db->select("*");
        $this->db->from($this->tabel);
        $this->db->where('date=', $date);
        if (!is_null($eventid)) {
            $this->db->where('eventid !=', $eventid);
        }

        $query = $this->db->get();
        // /die($this->db->last_query());
        $row = $query->result_array();
        return $row;
    }

    function hapus($eventid)
    {
        // delete from table payments
        $this->db->where('eventid=', $eventid);
        $this->db->delete($this->tabelpayment);

        //delete from table events
        $this->db->where('eventid=', $eventid);
        $this->db->delete($this->tabel);
    }
}
