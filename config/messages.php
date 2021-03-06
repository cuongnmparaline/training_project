<?php




#### Validate error
define("EMAIL_EXISTED", "Email is existed");
define("EMAIL_BLANK", "Email không được để trống");
define("PASS_BLANK", "Mật khẩu không được để trống");
define("NAME_BLANK", "Tên không được để trống");
define("SALARY_BLANK", "Lương không được để trống");
define("EMPLOYEE_BLANK", "Vui lòng chọn nhân viên");
define("WORKING_DAY_BLANK", "Số ngày công không được để trống");
define("MARRIAGE_BLANK", "Tình trạng hôn nhân không được để trống");
define("IDENTIFY_BLANK", "Chứng minh nhân dân không được để trống");
define("IDENTIFY_TIME_BLANK", "Ngày cấp không được để trống");
define("IDENTIFY_PLACE_BLANK", "Nơi cấp không được để trống");
define("NATIONALITY_BLANK", "Quốc tịch không được để trống");
define("ETHNIC_BLANK", "Dân tộc không được để trống");
define("TYPE_BLANK", "Loại nhân viên không được để trống");
define("DEGREE_BLANK", "Bằng cấp không được để trống");
define("GENDER_BLANK", "Giới tính không được để trống");
define("RESIDENCE_BLANK", "Hộ khẩu không được để trống");
define("STATUS_BLANK", "Trạng thái không được để trống");
define("DEPARTMENT_BLANK", "Phòng ban không được để trống");
define("POSITION_BLANK", "Chức vụ không được để trống");
define("EDUCATION_BLANK", "Trình độ không được để trống");
define("PHONE_BLANK", "Số điện thoại không được để trống");
define("ROLE_BLANK", "Trạng thái không được để trống");
define("DECISION_NUMBER_BLANK", "SỐ quyết định không được để trống");
define("DECISION_DAY_BLANK", "Ngày quyết định được để trống");
define("REWARD_NAME_BLANK", "Tên khen thưởng không được để trống");
define("REWARD_TYPE_BLANK", "Kiểu khen thưởng không được để trống");


define("DAY_START_BLANK", "Ngày bắt đầu không được để trống");
define("DAY_END_BLANK", "Ngày kết thúc không được để trống");
define("LOCATION_BLANK", "Địa điểm không được để trống");

define("WORKING_DAY_VALIDATE", "Ngày công phải là số và nhỏ hơn 31");
define("ADVANCE_VALIDATE", "Khoản tạm ứng phải nhỏ hơn 2/3 lương tháng");

define("PASS_VALIDATE", "Mật khẩu bao gồm chữ, số và ký tự, từ 6 đến 32 ký tự và viết hoa chữ cái đầu");
define("EMAIL_VALIDATE", "Email bao gồm chữ, số và ký tự, độ dài từ 6 đến 32 ký tự");
define("NAME_VALIDATE", "Name must be 0 to 128 characters");
define("SALARY_VALIDATE", "Lương phải là số");
define("POSITION_EMPLOYEE_VALIDATE", "Nhân viên này đang có lịch công tác vào những ngày này");


define("ACCOUNT_INCORRECT", "Tên tài khoản và mật khẩu không đúng!");
define("PASSWORD_INCORRECT", "Mật khẩu cũ bạn nhập không đúng!");
define("VERIFY_INCORRECT", "Mật khẩu nhập lại không khớp!");


define("ST_WRONG", "Có gì đó sai sai!");
define("CANT_FOUND_ACC", "Không thể tìm thấy tài khoản!");
define("CANT_FOUND_EMPLOYEE", "Không thể tìm thấy nhân viên!");
define("CANT_FOUND_BUSSINESS", "Không thể tìm thấy công tác!");
define("CANT_FOUND_SALARY", "Không thể tìm thấy bản ghi lương này!");
define("CANT_FOUND_DEPARTMENT", "Không thể tìm thấy phòng ban!");
define("CANT_FOUND_EDUCATION", "Không thể tìm thấy trình độ!");
define("CANT_FOUND_POSITION", "Không thể tìm thấy chức vụ!");
define("CANT_FOUND_TECHNIQUE", "Không thể tìm thấy chuyên môn!");
define("CANT_FOUND_DEGREE", "Không thể tìm thấy bằng cấp!");
define("CANT_FOUND_TYPE", "Không thể tìm thấy loại nhân viên!");
define("CANT_FOUND_TEAM", "Không thể tìm thấy nhóm");
define("CANT_FOUND_REWARD_TYPE", "Không thể tìm thấy loại khen thưởng");
define("CANT_FOUND_DISCIPLINE_TYPE", "Không thể tìm thấy loại kỷ luật");
define("CANT_FOUND_REWARD", "Không thể tìm thấy khen thưởng");
define("CANT_FOUND_DISCIPLINE", "Không thể tìm thấy khen thưởng");

define("EMPLOYEE_EXPORTED", "Xuất danh sách thông tin nhân viên thành công");
define("SALARY_EXPORTED", "Xuất bảng lương thành công");

# Department Success notification
define("DEPARTMENT_REMOVED", "Xóa bỏ phòng ban thành công!");
define("DEPARTMENT_CREATED", "Tạo mới phòng ban thành công!");
define("DEPARTMENT_UPDATED", "Cập nhập phòng ban thành công!");

# Education Success notification
define("EDUCATION_REMOVED", "Xóa bỏ trình độ thành công!");
define("EDUCATION_CREATED", "Tạo mới trình độ thành công!");
define("EDUCATION_UPDATED", "Cập nhập trình độ thành công!");

# Position Success notification
define("POSITION_REMOVED", "Xóa bỏ chức vụ thành công!");
define("POSITION_CREATED", "Tạo mới chức vụ thành công!");
define("POSITION_UPDATED", "Cập nhập chức vụ thành công!");

# Technique Success notification
define("TECHNIQUE_REMOVED", "Xóa bỏ chuyên môn thành công!");
define("TECHNIQUE_CREATED", "Tạo mới chuyên môn thành công!");
define("TECHNIQUE_UPDATED", "Cập nhập chuyên môn thành công!");

# Degree Success notification
define("DEGREE_REMOVED", "Xóa bỏ bằng cấp thành công!");
define("DEGREE_CREATED", "Tạo mới bằng cấp thành công!");
define("DEGREE_UPDATED", "Cập nhập bằng cấp thành công!");

# Type Success notification
define("TYPE_REMOVED", "Xóa bỏ loại nhân viên thành công!");
define("TYPE_CREATED", "Tạo mới loại nhân viên thành công!");
define("TYPE_UPDATED", "Cập nhập loại nhân viên thành công!");

define("EMPLOYEE_REMOVED", "Xóa nhân viên thành công!");
define("EMPLOYEE_CREATED", "Tạo mới nhân viên thành công!");
define("EMPLOYEE_UPDATED", "Chỉnh sửa nhân viên thành công!");

define("ACCOUNT_REMOVED", "Xóa tài khoản thành công!");
define("ACCOUNT_CREATED", "Tạo mới tài khoản thành công!");
define("ACCOUNT_UPDATED", "Chỉnh sửa tài khoản thành công!");
define("PASSWORD_UPDATED", "Cập nhập mật khẩu thành công!");

define("SALARY_REMOVED", "Xóa lương thành công!");
define("SALARY_CREATED", "Tạo mới lương thành công!");
define("SALARY_UPDATED", "Chỉnh sửa lương thành công!");

define("BUSSINESS_REMOVED", "Xóa công tác thành công!");
define("BUSSINESS_CREATED", "Tạo mới công tác hành công!");
define("BUSSINESS_UPDATED", "Chỉnh sửa công tác thành công!");

define("TEAM_REMOVED", "Xóa nhóm thành công!");
define("TEAM_CREATED", "Tạo mới nhóm hành công!");
define("TEAM_UPDATED", "Chỉnh sửa nhóm thành công!");
define("EMPLOYEE_ADDED", "Thêm nhân viên mới vào nhóm thành công!");
define("EMPLOYEE_MOVED", "Nhân viên đã bị xóa khỏi nhóm thành công!");

define("REWARD_TYPE_REMOVED", "Xóa loại khen thưởng thành công!");
define("REWARD_TYPE_CREATED", "Tạo mới loại khen thưởng thành công!");
define("REWARD_TYPE_UPDATED", "Chỉnh sửa loại khen thưởng thành công!");

define("REWARD_REMOVED", "Xóa khen thưởng thành công!");
define("REWARD_CREATED", "Tạo mới khen thưởng thành công!");
define("REWARD_UPDATED", "Chỉnh sửa khen thưởng thành công!");

define("DISCIPLINE_TYPE_REMOVED", "Xóa loại kỷ luật thành công!");
define("DISCIPLINE_TYPE_CREATED", "Tạo mới loại kỷ luật thành công!");
define("DISCIPLINE_TYPE_UPDATED", "Chỉnh sửa loại kỷ luật thành công!");

define("DISCIPLINE_REMOVED", "Xóa kỷ luật thành công!");
define("DISCIPLINE_CREATED", "Tạo mới kỷ luật thành công!");
define("DISCIPLINE_UPDATED", "Chỉnh sửa kỷ luật thành công!");

define("ROLE_ALERT", "Chỉ có quản trị viên mới có thể thực hiện thức năng này");

define("FORMAT_FILE_ERROR", "This file format is not supported");
define("SIZE_FILE_ERROR", "YOUR FILE CAN NOT BE OVER 5MB");








