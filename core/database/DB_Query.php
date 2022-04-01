<?php
 
if(session_status() === PHP_SESSION_NONE)
session_start();

require_once 'DB_Connection.php'; 

class DB_Queries extends DB_Connection
{
    public function Login($username, $password)
    {  
        $query = "SELECT * FROM users WHERE username = :username AND password = :pass";
        $statement = $this->conn->prepare($query);
        $statement->execute(['username' => $username, 'pass' => MD5($password)]);
        $num_row = $statement->rowCount(); 
        
        if ($num_row >= 1){  
            $_SESSION['login']    = true;  
            $_SESSION['username'] = $username; 
            return TRUE; 
        }  

        return FALSE;   
    }

    public function Signup($username, $password)
    {  
        $result = mysqli_query($this->CONN, "INSERT INTO users (username, password) VALUES ('".$username."', '".MD5($password)."')");   
          
        if ($result){  
            return true;  
        }  
 
        return false;  
    }

    public function GetTotalUsers()
    {  
        $query = "SELECT * FROM users";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement->rowCount();   
    }

    public function GetUserList()
    { 
        $query = "SELECT * FROM users";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function GetTotalStudents()
    {  
        $query = "SELECT * FROM students";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement->rowCount();   
    }

    public function GetStudentList()
    {  
        $query = "SELECT * FROM students JOIN course ON students.student_id=course.student_id
                ORDER BY course.id DESC";
        $statement = $this->conn->prepare($query);
        $statement->execute();
        return $statement->fetchAll();   
    }

    public function GetStudentByKeyword($keyword)
    {  
        $query = "SELECT * FROM students JOIN course ON students.student_id=course.student_id 
                WHERE students.lname LIKE :lastname OR students.fname LIKE :firstname 
                OR students.mname LIKE :middlename OR students.student_id LIKE :student_id 
                ORDER BY course.id DESC";
        $statement = $this->conn->prepare($query);
        $statement->execute([
            "lastname"   => $keyword,
            "firstname"  => $keyword,
            "middlename" => $keyword,
            "student_id" => $keyword
        ]);
        return $statement->fetchAll();   
    }

    public function GetTotalStudentsByMajor($major)
    {  
        $query = "SELECT * FROM students JOIN course ON students.student_id=course.student_id
                WHERE course.major = :major GROUP BY course.student_id";
        $statement = $this->conn->prepare($query);
        $statement->execute([
            'major' => $major
        ]);
        return $statement->rowCount();   
    }

    public function IsUsernameTaken($username)
    {
        $query = "SELECT * FROM users WHERE username = :username";
        $statement = $this->conn->prepare($query);
        $statement->execute(['username' => $username]);

        return $statement->rowCount() > 0 ? TRUE : FALSE;
    }

    public function IsStudentIDTaken($student_id)
    {
        $query = "SELECT * FROM students WHERE student_id = :student_id";
        $statement = $this->conn->prepare($query);
        $statement->execute(['student_id' => $student_id]);

        return $statement->rowCount() > 0 ? TRUE : FALSE;
    }

    public function AddStudent($student)
    {
        $query = "INSERT INTO students (student_id, lname, fname, mname) 
                VALUES (:student_id, :lastname, :firstname, :middlename)";
        $statement = $this->conn->prepare($query);
        return $statement->execute([
            'student_id' => $student['student_id'],
            'lastname'   => $student['lastname'],
            'firstname'  => $student['firstname'],
            'middlename' => $student['middlename'],
        ]) ? true : false;
    }

    public function AddStudentToCourse($course)
    {
        $query = "INSERT INTO course (student_id, yearlevel, section, major, a_y, sem) 
                VALUES (:student_id, :yearlevel, :section, :major, :a_y, :sem)";
        $statement = $this->conn->prepare($query);
        return $statement->execute([
            'student_id' => $course['student_id'],
            'yearlevel'  => $course['yearlevel'],
            'section'    => $course['section'],
            'major'      => $course['major'],
            'a_y'        => $course['a_y'],
            'sem'        => $course['sem'],
        ]) ? true : false;
    }

    public function AddUser($username, $password)
    {
        $query = "INSERT INTO users (username, password) 
                VALUES (:username, :password)";
        $statement = $this->conn->prepare($query);
        return $statement->execute([
            'username' => $username,
            'password' => MD5($password)
        ]) ? true : false;
    }

    public function GetStudentByID($info_id, $course_id)
    {
        $query = "SELECT students.*, course.* FROM students LEFT JOIN course ON students.student_id=course.student_id 
                WHERE students.id = :info_id AND course.id = :course_id";
        $statement = $this->conn->prepare($query);
        $statement->execute([
            'info_id'    => $info_id,
            'course_id'  => $course_id
        ]);
        return $statement->fetchAll();  
    }

    public function UpdateStudentInfo($student)
    {
        $query = "UPDATE students SET student_id = :student_id, lname = :lastname, 
                fname = :firstname, mname = :middlename WHERE id = :id";
        $statement = $this->conn->prepare($query);
        return $statement->execute([
            'student_id' => $student['student_id'],
            'lastname'   => $student['lastname'],
            'firstname'  => $student['firstname'],
            'middlename' => $student['middlename'],
            'id'         => $student['id'],
        ]) ? true : false; 
    }

    public function UpdateStudentCourse($course)
    {
        $query = "UPDATE course SET student_id = :student_id, yearlevel = :yearlevel, 
                section = :section, major = :major, a_y = :a_y, sem = :sem 
                WHERE id = :id";
        $statement = $this->conn->prepare($query);
        return $statement->execute([
            'student_id' => $course['student_id'],
            'yearlevel'  => $course['yearlevel'],
            'section'    => $course['section'],
            'major'      => $course['major'],
            'a_y'        => $course['a_y'],
            'sem'        => $course['sem'],
            'id'         => $course['id'],
        ]) ? true : false; 
    }

    public function DeleteStudentInfo($id)
    {
        $query = "DELETE FROM students WHERE id = :id";
        $statement = $this->conn->prepare($query);
        return $statement->execute([
            'id' => $id,
        ]) ? true : false;
    }

    public function DeleteStudentCourse($student_id)
    {
        $query = "DELETE FROM course WHERE student_id = :student_id";
        $statement = $this->conn->prepare($query);
        return $statement->execute([
            'student_id' => $student_id,
        ]) ? true : false; 
    }

    public function DeleteUser($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $statement = $this->conn->prepare($query);
        return $statement->execute([
            'id' => $id,
        ]) ? true : false; 
    }
}