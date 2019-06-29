<? php
	require_once('connection.php');

	function getId(){
        return time();
    }

    function confirmPass($hash,$pass){
        if(md5($pass) == $hash){
            return true;
        }

        return false;
    }


    function login($email,$pass){
        
        $conn = connect();
        $res = [];

        try{
            $query = $conn->prepare("SELECT * FROM users WHERE email=:email");
            $query->bindParam(":email",$email);

            $query->execute();
            $user = $query->fetch();

            if($user){
                $res['status'] = confirmPass($user['password'],$pass);

                $res['user'] = $arrayName = array('_id' => $user['_id'] , 'email' => $user['email'],
                                                     'fullname' => $user['fullname'], 'username' => $user['username']);

                return $res;
            }

            $res['msg'] = "Email or Username doesnt exist";
            $res['status'] = false;

            return $res;

        }
        catch(PDOException $e){
            $res['msg'] = "Something went wrong cant log you in at the moment";
            $res['status'] = false;

            return $res;
        }

    }


    function register($fname, $email, $password $phone){
        $conn = connect();
        $pass_hash =md5($password);
        $epo = new DateTime();
        $date = $epo->format('Y-m-d H:i:s');
        $res = [];

        try{
            $query = $conn->prepare("INSERT INTO users ( fulname, email, password, phone, created_at, last_loggedIn )
            VALUES(:fullname, :email, :password, :phone, :created_at, :last_login)");
            $query->bindParam(':_id',$id);
            $query->bindParam(':fullname',$fname);
            $query->bindParam(':email',$email);
            $query->bindParam(':username',$uname);
            $query->bindParam(':password',$pass_hash);
            $query->bindParam(':created_at',$date);
            $query->bindParam(':last_login',$date);

            $query->execute();

            $res['msg'] = " user has been added successfully";
            $res['status'] = true;

            return $res;
        }
        catch(PDOException $ex){
             
            $res['msg'] = $ex->getMessage();
            $res['status'] = true;

            return $res;
        }
        
    }

    function addProp($prop){
    	$conn = connect();
        try{

            $sql = "INSERT INTO properties (_id, title, area,added_date, category, p_type, section, price, service, caution, beds, baths,park,land_size,prop_size, location, near_place,
            	com_status, p_title, lease_term, e_platform, floor, avail_floor, linkToProp,
            	link_contact, cortts_agent, features, prop_desc, remark, images)
            VALUES(:_id, :title, :area, :added_date, :category, :p_type, :section, :price, :service, :caution, :beds, :baths, :park, :land_size, :prop_size, :location, :near_place,
            	:com_status, :p_title, :lease_term, :e_platform, :floor, :avail_floor, :linkToProp,
            	:link_contact, :cortts_agent, :features, :prop_desc, :remark, :images)";
            

            $query =  $conn->prepare($sql);
            $query->bindParam(':_id', getId());
            $query->bindParam(':title', $prop['title']);
            $query->bindParam(':area', $prop['title']);
            $query->bindParam(':added_date', $prop['added_date']);
            $query->bindParam(':category', $prop['category']);
            $query->bindParam(':p_type', $prop['p_type']);
            $query->bindParam(':section', $prop['section']);
            $query->bindParam(':price', $prop['price']);
            $query->bindParam(':service', $prop['service']);
            $query->bindParam(':caution', $prop['caution']);
            $query->bindParam(':beds', $prop['beds']);
            $query->bindParam(':baths', $prop['baths']);
            $query->bindParam(':land_size', $prop['land_size']);
            $query->bindParam(':prop_size', $prop['prop_size']);
            $query->bindParam(':location', $prop['location']);
            $query->bindParam(':near_place', $prop['near_place']);
            $query->bindParam(':com_status', $prop['com_status']);
            $query->bindParam(':p_title', $prop['p_title']);
            $query->bindParam(':lease_term', $prop['lease_term']);
            $query->bindParam(':e_platform', $prop['e_platform']);
            $query->bindParam(':floor', $prop['floor']);
            $query->bindParam(':avail_floor', $prop['avail_floor']);
            $query->bindParam(':linkToProp', $prop['linkToProp']);
            $query->bindParam(':link_contact', $prop['link_contact']);
            $query->bindParam(':cortts_agent', $prop['cortts_agent']);
            $query->bindParam(':prop_desc', $prop['prop_desc']);
            $query->bindParam(':features', $prop['features']);
            $query->bindParam(':remark', $prop['remark']);
            $query->bindParam(':images', $prop['images']);
            $query->bindParam(':park', $prop['park']);

            

            //$aId = $conn->lastInsertId();

            $ret = $query->execute();

            if($ret){
                $res = array('status' => true, 'msg' => "property saved successfully", 'array' => $ret);
                return $res;
            }else{
                $res = array('status' => false, 'msg' => "Couldnt save property ",'array' => $ret);
                return $res;
            }
        }
        catch(PDOException $ex){

            $res = array('status' => false, 'msg' => $ex->getMessage());
            return $res;
    
        }
    }

    function delProp($id,$table){
    	$conn = connect();

        try{
            $sql = "DELETE FROM ".$table." WHERE _id=".$id;

            $conn->exec($sql);
            return array('status' => true, 'msg' => "delete successful");

        }catch(PDOException $e){
            return array('status' => false, 'msg' => $e->getMessage());
        }
    }

    function editProp($prop){
    	$conn = connect();
        try{

            $sql = "UPDATE properties SET title=:title, area=:area, added_date=:added_date, category=:category, p_type=:p_type, section=:section, price=:price, service=:service, caution=:caution, beds=:beds, baths=:baths, park=:park, land_size=:land_size, prop_size=:prop_size, location=:location, near_place=:near_place, com_status=:com_status, p_title=:p_title, lease_term=:lease_term, e_platform=:e_platform, floor=:floor, avail_floor=:avail_floor, linkToProp=:linkToProp, link_contact=:link_contact, cortts_agent=:cortts_agent, features=:features, prop_desc=:prop_desc, remark=:remark, images=:images WHERE _id=:_id)";

            $query =  $conn->prepare($sql);
            $query->bindParam(':_id', getId());
            $query->bindParam(':title', $prop['title']);
            $query->bindParam(':area', $prop['title']);
            $query->bindParam(':added_date', $prop['added_date']);
            $query->bindParam(':category', $prop['category']);
            $query->bindParam(':p_type', $prop['p_type']);
            $query->bindParam(':section', $prop['section']);
            $query->bindParam(':price', $prop['price']);
            $query->bindParam(':service', $prop['service']);
            $query->bindParam(':caution', $prop['caution']);
            $query->bindParam(':beds', $prop['beds']);
            $query->bindParam(':baths', $prop['baths']);
            $query->bindParam(':land_size', $prop['land_size']);
            $query->bindParam(':prop_size', $prop['prop_size']);
            $query->bindParam(':location', $prop['location']);
            $query->bindParam(':near_place', $prop['near_place']);
            $query->bindParam(':com_status', $prop['com_status']);
            $query->bindParam(':p_title', $prop['p_title']);
            $query->bindParam(':lease_term', $prop['lease_term']);
            $query->bindParam(':e_platform', $prop['e_platform']);
            $query->bindParam(':floor', $prop['floor']);
            $query->bindParam(':avail_floor', $prop['avail_floor']);
            $query->bindParam(':linkToProp', $prop['linkToProp']);
            $query->bindParam(':link_contact', $prop['link_contact']);
            $query->bindParam(':cortts_agent', $prop['cortts_agent']);
            $query->bindParam(':prop_desc', $prop['prop_desc']);
            $query->bindParam(':features', $prop['features']);
            $query->bindParam(':remark', $prop['remark']);
            $query->bindParam(':images', $prop['images']);
            $query->bindParam(':park', $prop['park']);

            

            //$aId = $conn->lastInsertId();

            $ret = $query->execute();

            if($ret){
                $res = array('status' => true, 'msg' => "property saved successfully", 'array' => $ret);
                return $res;
            }else{
                $res = array('status' => false, 'msg' => "Couldnt save property ",'array' => $ret);
                return $res;
            }
        }
        catch(PDOException $ex){

            $res = array('status' => false, 'msg' => $ex->getMessage());
            return $res;
    
        }
    }

    function getProps(){
    	$conn = connect();
        $res = [];

        try{
            $query = $conn->prepare("SELECT * FROM properties");

            $query->execute();

            $props = $query->fetchAll();


            if($props){

                $res['props'] = $props;
                $res['status'] = true;
                return $res;
            }

            $res['props'] = [];
            $res['status'] = false;
            return $res;
        }
        catch(PDOException $e){
            $res['msg'] = $e->getMessage();
            $res['status'] = false;
            return $res;
        }
    }
?>