<?php
defined('BASEPATH') or exit('No direct script access allowed');
class RestModel extends CI_Model
{
    public function __construct()
    {
        header('Access-Control-Allow-Origin: *');
    }
    public function category_data()
    {
        $sql = "SELECT article_db_id as id,url_rewrite as slug,category_name as name FROM article_db WHERE is_category=1";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function article_data($cat_id)
    {
        $sql = "SELECT article_db_id as id,title,IF(main_picture IS NULL or main_picture = '', '', CONCAT('".base_url()."photo/plugin/article/',main_picture)) as image,short_desc as short,content as note FROM article_db WHERE active=1 AND cat_id=".$cat_id;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function sportscenter_data($cat_id)
    {
        $sql = "SELECT 'false' as active,article_db_id as id,title,IF(main_picture IS NULL or main_picture = '', '', CONCAT('".base_url()."photo/plugin/article/',main_picture)) as image,short_desc as short,content as note FROM article_db WHERE active=1 AND cat_id=".$cat_id;
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function program_data()
    {
        $sql = "SELECT (SELECT category_slug FROM article_db WHERE article_db_id = adb.cat_id) as category_slug,(SELECT category_name FROM article_db WHERE article_db_id = adb.cat_id) as category_name,title,content,IF(brochure_path IS NULL or brochure_path = '', '', CONCAT('".base_url()."photo/plugin/article/',brochure_path)) as pdf,keyword as tags,CONCAT('".base_url()."photo/programs/',(SELECT url_rewrite FROM article_db WHERE article_db_id = adb.cat_id),'.jpg') as url_rewrite,IF(main_picture IS NULL or main_picture = '', '', CONCAT('".base_url()."photo/plugin/article/',main_picture)) as image,video_url FROM article_db adb WHERE adb.active=1 AND adb.cat_id IN ( SELECT article_db_id FROM article_db WHERE main_cat_id=2 AND url_rewrite!='international-programs')  ORDER BY cat_id,timestamp_create";
        $query = $this->db->query($sql);
        $aRes = $query->result_array();
        $aFinal = array();
        $vCateg = '';
        $j=-1;
        $k=-1;
        for ($i=0;$i<count($aRes);$i++) {
            if ($vCateg != $aRes[$i]['category_name']) {
                $j++;
                $k=-1;
                $aFinal[$j]['category'] = $aRes[$i]['category_name'];
                $aFinal[$j]['category_img'] = $aRes[$i]['url_rewrite'];
            }
            if ($aRes[$i]['title']=='M.B.A. Digital Track') {
                $k++;
                $aFinal[$j]['subs'][$k] = array('category_slug'=>$aRes[$i]['category_slug'],'image'=>$aRes[$i]['image'],'pdf'=>$aRes[$i]['pdf'],'video'=>$aRes[$i]['video_url'],'subcategory'=>$aRes[$i]['title'],'content'=>$aRes[$i]['content'],'tags'=>$aRes[$i]['tags']);
                $k++;
                $aIP = $this->international_program_data();
                $aFinal[$j]['subs'][$k] = $aIP[0];
            } else {
                $k++;
                $aFinal[$j]['subs'][$k] = array('category_slug'=>$aRes[$i]['category_slug'],'image'=>$aRes[$i]['image'],'pdf'=>$aRes[$i]['pdf'],'video'=>$aRes[$i]['video_url'],'subcategory'=>$aRes[$i]['title'],'content'=>$aRes[$i]['content'],'tags'=>$aRes[$i]['tags']);
            }
            //$k++;
            //$aFinal[$j]['subs'][$k] = array('category_slug'=>$aRes[$i]['category_slug'],'image'=>$aRes[$i]['image'],'video'=>$aRes[$i]['video_url'],'subcategory'=>$aRes[$i]['title'],'content'=>$aRes[$i]['content'],'tags'=>$aRes[$i]['tags']);
            $vCateg = $aRes[$i]['category_name'];
        }
        return $aFinal;
    }

    public function international_program_data()
    {
        $sql = "SELECT 'international programs' category_slug,(SELECT category_name FROM article_db WHERE article_db_id = adb.cat_id) as category_name,title,content,IF(brochure_path IS NULL or brochure_path = '', '', CONCAT('".base_url()."photo/plugin/article/',brochure_path)) as pdf,keyword as tags,CONCAT('".base_url()."photo/programs/',(SELECT url_rewrite FROM article_db WHERE article_db_id = adb.cat_id),'.jpg') as url_rewrite,IF(main_picture IS NULL or main_picture = '', '', CONCAT('".base_url()."photo/plugin/article/',main_picture)) as image,video_url FROM article_db adb WHERE adb.active=1 AND adb.cat_id IN ( SELECT article_db_id FROM article_db WHERE url_rewrite='international-programs')  ORDER BY cat_id,timestamp_create";
        $query = $this->db->query($sql);
        $aRes = $query->result_array();
        $aFinal = array();
        $vCateg = '';
        $j=-1;
        $k=-1;
        for ($i=0;$i<count($aRes);$i++) {
            if ($vCateg != $aRes[$i]['category_name']) {
                $j++;
                $k=-1;
                $aFinal[$j]['subcategory'] = $aRes[$i]['category_name'];
                $aFinal[$j]['category_img'] = $aRes[$i]['url_rewrite'];
                $aFinal[$j]['flag'] = true;
            }
            $k++;
            $aFinal[$j]['subs'][$k] = array('category_slug'=>$aRes[$i]['category_slug'],'image'=>$aRes[$i]['image'],'pdf'=>$aRes[$i]['pdf'],'video'=>$aRes[$i]['video_url'],'subcategory'=>$aRes[$i]['title'],'content'=>$aRes[$i]['content'],'tags'=>$aRes[$i]['tags']);
            $vCateg = $aRes[$i]['category_name'];
        }
        return $aFinal;
    }

    public function student_data()
    {
        $sql = "SELECT (SELECT category_slug FROM article_db WHERE article_db_id = adb.cat_id) as category_slug,(SELECT category_name FROM article_db WHERE article_db_id = adb.cat_id) as category_name,title,IF(main_picture IS NULL or main_picture = '', '', CONCAT('".base_url()."photo/plugin/article/',main_picture)) as image,short_desc as short,content as note FROM article_db adb WHERE adb.cat_id IN (112,119)  ORDER BY cat_id";
        $query = $this->db->query($sql);
        $aRes = $query->result_array();
        $aFinal = array();
        $vCateg = '';
        $j=-1;
        $k=-1;
        for ($i=0;$i<count($aRes);$i++) {
            if ($vCateg != $aRes[$i]['category_name']) {
                $j++;
                $k=-1;
                $aFinal[$j]['category'] = $aRes[$i]['category_name'];
            }
            $k++;
            $aFinal[$j]['subs'][$k] = array('title'=>$aRes[$i]['title'],'note'=>$aRes[$i]['note'],'image'=>$aRes[$i]['image']);
            $vCateg = $aRes[$i]['category_name'];
        }
        return $aFinal;
    }


    public function book_create_data($data)
    {
        $this->db->insert('books', $data);
        return array('status' => 201,'message' => 'Data has been created.');
    }
    public function book_update_data($id, $data)
    {
        $this->db->where('id', $id)->update('books', $data);
        return array('status' => 200,'message' => 'Data has been updated.');
    }
    public function book_delete_data($id)
    {
        $this->db->where('id', $id)->delete('books');
        return array('status' => 200,'message' => 'Data has been deleted.');
    }
    public function banner_data()
    {
        $sql = "SELECT banner_mgt_id as ID, CONCAT('".base_url()."photo/banner/',img_path) as URL FROM banner_mgt WHERE active=1 AND mobile_flag=1 ORDER BY id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function web_banner_data()
    {
        $sql = "SELECT banner_mgt_id as ID, CONCAT('".base_url()."photo/banner/',img_path) as URL FROM banner_mgt WHERE active=1 AND mobile_flag=0 ORDER BY id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
}
