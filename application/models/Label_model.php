<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Class : Login_model (Login Model)
 * Login model class to get to authenticate user credentials
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 15 November 2016
 */
class Label_model extends CI_Model
{

    public $uploadFolder = FCPATH . 'uploads/LabelImages';

    function registernewlabel($labelInfo)
    {
        try {
            // $this->db->trans_start();
            if ($this->db->insert('tbl_label', $labelInfo))
                $insert_id = $this->db->insert_id();
            else
                $insert_id = -1;
            //$this->db->trans_complete();
            return $insert_id;
        }

        catch (Exception $ex)
        {
            return -1;
        }
    }

    public function getLabelById($id)
    {
        $this->db->from('tbl_label');
        $this->db->where('id', $id);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();
        return $query->result();
    }

    function getFoundLabelsByUserId($userId)
    {
            $this->db->select('id');
            $this->db->from('tbl_label');
            $this->db->where('isDeleted', 0);
            $this->db->where('userId', $userId );
			$this->db->where('userfoundId', $userId);
			$this->db->where('userclaimId IS NULL');
			$query = $this->db->get();
			$testquery=$this->db->last_query();
			// why here false should be 0
            return $query->num_rows();
    }

	function generateCodeAndInsertLabelFound($labelInfo)
	{
		// 3x label2 aanpassen + in   function updateimg($userInfo,$id){ in User_model

		try
		{
			$set = '3456789abcdefghjkmnpqrstvwxyABCDEFGHJKLMNPQRSTVWXY';
			do
			{
				do
				{
					$code = 'F-' . substr(str_shuffle($set), 0, 8);
				}
				while ($this->doesUniquecodeExist($code));  // code in tbl_uniquecodes table?

				$this->db->select('id');
				$this->db->from('tbl_label');
				$this->db->where('code', $code);
				$query = $this->db->get();
			}
			while (!empty($query->row()));  // code in tbl_label table?

			// $code = 'G-vmYM5psA';
			$labelInfo['code'] = $code;
			if ($this->db->insert('tbl_label', $labelInfo))
				$insert_id = $this->db->insert_id();
			else
				$insert_id = -1;

			if ($insert_id > 0)
			{
				$this->db->select('id, code');
				$this->db->from('tbl_label');
				$this->db->where('id', $insert_id);
				$query = $this->db->get();
				return $query->row();
			}
			else
				return null;
		}

		catch (Exception $ex)
		{
			return null;
		}
	}

    public function generateCodeAndInsertLabel(array $labelInfo) : ?object
    {
        try {
            $this->db->insert('tbl_label', $labelInfo);
            $insert_id = $this->db->insert_id();
            if ($insert_id) {
                $this->db->select('id, userId, code, image');
                $this->db->from('tbl_label');
                $this->db->where('id', $insert_id);
                $query = $this->db->get();
                return $query->row();
            } else {
                return null;
            }
        } catch (Exception $ex) {
            return null;
        }
    }

    function getLabelInfoById($id, $userId)
    {
        $this->db->select('code');
        $this->db->from('tbl_label');
        $this->db->where('id', $id);
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $query = $this->db->get();

        return $query->row();
    }

    function getLabelInfoByCode($code = '', $id = '')
    {
        if (!$id && !$code) return null;
        $this->db->select(
            'tbl_label.id as labelId, 
            tbl_label.userId, 
            tbl_label.userfoundId,
            tbl_label.userclaimId, 
            tbl_label.descript, 
            tbl_label.categoryid, 
            tbl_label.image, 
            tbl_label.code, 
            tbl_label.isDeleted,
            tbl_label.createdDtm, 
            tbl_user.business_type_id,
            tbl_category.description AS categoryDescription,
            claimer.username AS claimerName,
            claimer.email AS claimerEmail,
            claimer.id AS claimerId'
                     
        );
        $this->db->from('tbl_label');
        $this->db->join('tbl_category', 'tbl_label.categoryid = tbl_category.id', 'LEFT');
        $this->db->join('tbl_user', 'tbl_label.userId = tbl_user.id', 'LEFT');
        $this->db->join('tbl_user AS claimer', 'tbl_label.userclaimid = claimer.id', 'LEFT');
        $this->db->where('tbl_label.isDeleted', 0);
        if ($id) {
            $this->db->where('tbl_label.id', $id);
        } elseif ($code) {
            $this->db->where('tbl_label.code', $code);
        }
        $query = $this->db->get();
        return $query->row();
    }

    function editLabel($labelInfo, $userId, $labelId)
    {
        try {
            $this->db->where('id', $labelId);
            $this->db->where('isDeleted', 0);
            $this->db->where('userId', $userId);
            $this->db->update('tbl_label', $labelInfo);
            return TRUE;
        }

        catch (Exception $ex)
        {
            return FALSE;
        }
    }

    function doesUniquecodeExist($code)
    {
        $this->db->select('id');
        $this->db->from('tbl_uniquecodes');
        $this->db->where('code', $code);
        $query = $this->db->get();
        return !empty($query->row());
    }

    function doesUserdefinedcodeExist($code)
    {
        $this->db->select('id');
        $this->db->from('tbl_label');
        $this->db->where('code', $code);
        $query = $this->db->get();

        return !empty($query->row());
    }

	function generateCode()
	{
			$data = [];
			do {
				$set = '3456789abcdefghjkmnpqrstvwxyABCDEFGHJKLMNPQRSTVWXY';
				$data = [
					'timestamp' => date('Y-m-d H:i:s'),
					'code' => 'PH-' . substr(str_shuffle($set), 0, 8),
				];
			} while (!$this->insert($data));
			return $data['code'];
	}
    
    public function update(array $labelInfo, array $where)
    {
        $this->db->where($where);
        return $this->db->update('tbl_label', $labelInfo);
    }

    public function findUserClaimByCode(array $what, string $code): array
    {
        $what = implode(',', $what);
        return $this->db
            ->select($what)
            ->join('tbl_label', 'tbl_label.userclaimId = tbl_user.id', 'INNER')
            ->where('tbl_label.code', $code)
            ->get('tbl_user')
            ->result_array();
    }

    public function fetchLabel(): array
    {
        if (isset($this->id)) {
            $where = ['tbl_label.id' => $this->id];
        } elseif (isset($this->code)) {
            $where = ['tbl_label.code' => $this->code];
        } else {
            return [];
        }
        // tbl_label.userfoundid AS labelUserFoundId, 
        //         tbl_label.userclaimid AS labelUserClaimId, 
        return $this->db
            ->select(
                'tbl_label.id AS labelId, 
                tbl_label.descript AS labelDescription, 
                tbl_label.code AS labelCode,
                tbl_label.dclw AS labelDclw, 
                tbl_label.dcll AS labelDcll,
                tbl_label.dclh AS labelDclh, 
                tbl_label.dclwgt AS labelDclwgt, 

                owner.id AS ownerId,
                owner.username AS ownerUsername,
                owner.email AS ownerEmail,
                owner.roleid AS ownerRoleId,
                owner.mobile AS ownerMobile,
                owner.IsDropOffPoint AS ownerDropOffPoint,
                owner.address AS ownerAddress,
                owner.addressa AS ownerAddressa,
                owner.city AS ownerCity,
                owner.zipcode AS ownerZipcode,
                owner.country AS ownerCountry,
                owner.gmtOffSet AS ownerGmtOffSet,

                claimer.id AS claimerId,
                claimer.username AS claimerUsername,
                claimer.email AS claimerEmail,
                claimer.roleid AS claimerRoleId,
                claimer.mobile AS claimerMobile,
                claimer.IsDropOffPoint AS claimerDropOffPoint,
                claimer.address AS claimerAddress,
                claimer.addressa AS claimerAddressa,
                claimer.city AS claimerCity,
                claimer.zipcode AS claimerZipcode,
                claimer.country AS claimerCountry,
                claimer.gmtOffSet AS claimerGmtOffSet,

                finder.id AS finderId,
                finder.username AS finderUsername,
                finder.email AS finderEmail,
                finder.roleid AS finderRoleId,
                finder.mobile AS finderMobile,
                finder.IsDropOffPoint AS finderDropOffPoint,
                finder.address AS finderAddress,
                finder.addressa AS finderAddressa,
                finder.city AS finderCity,
                finder.zipcode AS finderZipcode,
                finder.country AS finderCountry,
                finder.gmtOffSet AS finderGmtOffSet,'                
            )
            ->join('tbl_user AS owner', 'tbl_label.userid = owner.id', 'LEFT')
            ->join('tbl_user AS claimer', 'tbl_label.userclaimid = claimer.id', 'LEFT')
            ->join('tbl_user AS finder', 'tbl_label.userfoundid = finder.id', 'LEFT')            
            ->where($where)
            ->get('tbl_label')
            ->result_array();
    }

    public function filterLabels(array $where): array
    {
        $this->db->select(
            'BaseTbl.id,
            BaseTbl.userId,
            tbl_category.description as categoryname,
            BaseTbl.userfoundId,
            BaseTbl.isDeleted,
            BaseTbl.code,
            BaseTbl.descript,
            BaseTbl.lost,
            BaseTbl.createdDtm,
            BaseTbl.image,
            BaseTbl.categoryid,
            BaseTbl.userclaimId,
            BaseTbl.lat,
            BaseTbl.lng,
            BaseTbl.finder_fee,
            tbl_employee.username AS employee,
            tbl_user.username AS owner,
            tbl_dhl.id AS dhlId,
            tbl_dhl.dhlordernr AS dhlordernr,
            tbl_dhl.dhlcode AS dhlErrorNumber,
            tbl_payments_history.paystatus AS paystatus,
            tbl_payments_history.orderstatusid AS orderstatusid,
            tbl_payments_history.errorMessage AS systemErrorMessage'            
        );
        $this->db->from('tbl_label as BaseTbl');
        $this->db->join('tbl_category', 'tbl_category.id = BaseTbl.categoryid','left');
        $this->db->join('tbl_user', 'tbl_user.id = BaseTbl.userId','inner');
        $this->db->join('tbl_employee', 'BaseTbl.employeeId = tbl_employee.id','left');

        $this->db->join('tbl_dhl', 'tbl_dhl.labelId = BaseTbl.id','left');
        $this->db->join('tbl_payments_history', 'tbl_payments_history.dhlId = tbl_dhl.id','left');
        foreach($where as $key => $value) {
            if ($value || is_numeric($value)) {
                $this->db->where('BaseTbl.' . $key, $value);
            }
        }
        $this->db->order_by('BaseTbl.createdDtm', 'DESC');     
        $this->db->order_by('tbl_payments_history.id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function insert(array $data): bool
    {
        $this->db->insert('tbl_label', $data);
        $this->id = $this->db->insert_id();
        return $this->id ? true : false;
    }

    public function getItemsInPointRadius(float $lat, float $lng, float $radius, int $lost): array
    {
        $query =
            'SELECT 
                tbl_label.id AS id,
                tbl_label.descript AS Description,
                tbl_category.description AS Category, 
                tbl_label.finder_fee AS reward, 
                tbl_label.lat AS lat, 
                tbl_label.lng AS lng, 
                CONCAT("' . base_url() . 'found/", tbl_label.code) AS clickurl,
                CONCAT("' . base_url() . 'uploads/LabelImages/", tbl_label.userId, "-", tbl_label.code, "-", tbl_label.image ) AS iconimage,                
                (
                    6371000 * acos(
                        cos( radians(' . $lat . ') ) 
                        * cos( radians(tbl_label.lat) ) 
                        * cos( radians(tbl_label.lng) - radians(' . $lng . ')) 
                        + sin(radians(' . $lat . ')) 
                        * sin(radians(tbl_label.lat))
                    )
                ) as distance
                FROM tbl_label
                INNER JOIN tbl_category ON tbl_label.categoryid = tbl_category.id 
                WHERE tbl_label.lost = ' . $lost . ' HAVING distance <' . $radius . ';';

        $result = $this->db->query($query);
        return $result->result_array();
    }

    public function select(array $what, array $where = []): array
    {
        $this->db->select(implode(',', $what));
        $this->db->from('tbl_label');
        if (!empty($where)) {
            foreach($where as $key => $value) {
                $this->db->where([$key => $value]);
            }    
        }
        return $this->db->get()->result_array();
    }
}