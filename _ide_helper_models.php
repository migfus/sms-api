<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\BloodType
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|BloodType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodType query()
 * @method static \Illuminate\Database\Eloquent\Builder|BloodType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BloodType whereUserId($value)
 */
	class BloodType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\CivilStatus
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CivilStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CivilStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CivilStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|CivilStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CivilStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CivilStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CivilStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CivilStatus whereUserId($value)
 */
	class CivilStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Education
 *
 * @property int $id
 * @property int $info_id
 * @property int $level
 * @property string $school
 * @property string|null $degree
 * @property string $from
 * @property string|null $to
 * @property string|null $scholarship
 * @property string|null $honors
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\EducationLevel|null $education_levels
 * @method static \Illuminate\Database\Eloquent\Builder|Education newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Education newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Education query()
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereDegree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereHonors($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereInfoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereScholarship($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereSchool($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Education whereUpdatedAt($value)
 */
	class Education extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EducationLevel
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EducationLevel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EducationLevel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EducationLevel query()
 * @method static \Illuminate\Database\Eloquent\Builder|EducationLevel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducationLevel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducationLevel whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducationLevel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EducationLevel whereUserId($value)
 */
	class EducationLevel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Eligibility
 *
 * @property int $id
 * @property int $info_id
 * @property string $name
 * @property int $address_id
 * @property string $rating
 * @property string $exam_date
 * @property string $validity_date
 * @property string $number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Eligibility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Eligibility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Eligibility query()
 * @method static \Illuminate\Database\Eloquent\Builder|Eligibility whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eligibility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eligibility whereExamDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eligibility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eligibility whereInfoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eligibility whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eligibility whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eligibility whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eligibility whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Eligibility whereValidityDate($value)
 */
	class Eligibility extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @property int $id
 * @property int $user_id
 * @property int $event_category_id
 * @property string $title
 * @property string $start
 * @property string $end
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\EventCategory|null $EventCategory
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEventCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStart($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUserId($value)
 */
	class Event extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\EventCategory
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $bg_color
 * @property string $text_color
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory whereBgColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory whereTextColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EventCategory whereUserId($value)
 */
	class EventCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Experience
 *
 * @property int $id
 * @property int $info_id
 * @property string $position
 * @property string $company
 * @property string $from
 * @property string|null $to
 * @property string|null $salary
 * @property int $salary_type_id
 * @property int|null $sg
 * @property int $work_status_id
 * @property int $is_government
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\WorkStatus|null $work_status
 * @method static \Illuminate\Database\Eloquent\Builder|Experience newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Experience newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Experience query()
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereInfoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereIsGovernment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereSalaryTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereSg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Experience whereWorkStatusId($value)
 */
	class Experience extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FAQ
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $phone
 * @property int $answer_user_id
 * @property int|null $approved_user_id
 * @property string $question
 * @property string $answer
 * @property int $points
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ query()
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereAnswerUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereApprovedUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ wherePoints($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FAQ whereUpdatedAt($value)
 */
	class FAQ extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\File
 *
 * @property int $id
 * @property int $info_id
 * @property string $filename
 * @property string $url
 * @property int $size
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|File newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|File query()
 * @method static \Illuminate\Database\Eloquent\Builder|File whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereFilename($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereInfoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|File whereUrl($value)
 */
	class File extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Info
 *
 * @property int $id
 * @property int $user_id
 * @property string $last_name
 * @property string $first_name
 * @property string|null $mid_name
 * @property string|null $ext_name
 * @property int $civil_status_id
 * @property string $birth_day
 * @property int $birth_place_id
 * @property int $blood_type_id
 * @property int $sex
 * @property string $height
 * @property string $weight
 * @property int $address_id
 * @property string $address specific address
 * @property string|null $gsis_id
 * @property string|null $pagibig_id
 * @property string|null $tin_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BloodType|null $blood_type
 * @property-read \App\Models\CivilStatus|null $civil_status
 * @method static \Illuminate\Database\Eloquent\Builder|Info newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Info newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Info query()
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereBirthDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereBirthPlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereBloodTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereCivilStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereExtName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereGsisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereMidName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info wherePagibigId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereTinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Info whereWeight($value)
 */
	class Info extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Job
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $posted_at
 * @property string $unposted_at
 * @property int $job_location_id
 * @property int $job_department_id
 * @property int $job_type_id
 * @property int $job_status_id
 * @property string $requirements
 * @property string $responsibilities
 * @property string $qualifications
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\JobDepartment|null $JobDepartment
 * @property-read \App\Models\JobLocation|null $JobLocation
 * @property-read \App\Models\JobStatus|null $JobStatus
 * @property-read \App\Models\JobType|null $JobType
 * @method static \Illuminate\Database\Eloquent\Builder|Job newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Job newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Job query()
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereJobDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereJobLocationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereJobStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereJobTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job wherePostedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereQualifications($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereRequirements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereResponsibilities($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereUnpostedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Job whereUserId($value)
 */
	class Job extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\JobDepartment
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|JobDepartment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobDepartment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobDepartment query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobDepartment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobDepartment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobDepartment whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobDepartment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobDepartment whereUserId($value)
 */
	class JobDepartment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\JobLocation
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|JobLocation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobLocation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobLocation query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobLocation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobLocation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobLocation whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobLocation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobLocation whereUserId($value)
 */
	class JobLocation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\JobStatus
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobStatus whereUpdatedAt($value)
 */
	class JobStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\JobType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|JobType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|JobType query()
 * @method static \Illuminate\Database\Eloquent\Builder|JobType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|JobType whereUpdatedAt($value)
 */
	class JobType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\MobileNumber
 *
 * @property int $id
 * @property int $info_id
 * @property int $allow_notify
 * @property string $number
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MobileNumber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MobileNumber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MobileNumber query()
 * @method static \Illuminate\Database\Eloquent\Builder|MobileNumber whereAllowNotify($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MobileNumber whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MobileNumber whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MobileNumber whereInfoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MobileNumber whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MobileNumber whereUpdatedAt($value)
 */
	class MobileNumber extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Person
 *
 * @property int $id
 * @property string $last_name
 * @property string $first_name
 * @property string|null $mid_name
 * @property string|null $ext_name
 * @property int $civil_status_id
 * @property string $birth_day
 * @property int $birth_place_id
 * @property int $blood_type_id
 * @property int $sex
 * @property string $height
 * @property string $weight
 * @property int $address_id
 * @property string $address specific address
 * @property string|null $gsis_id
 * @property string|null $pagibig_id
 * @property string|null $tin_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\BloodType|null $blood_type
 * @property-read \App\Models\CivilStatus|null $civil_status
 * @method static \Illuminate\Database\Eloquent\Builder|Person newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Person query()
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereAddressId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereBirthDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereBirthPlaceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereBloodTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCivilStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereExtName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereGsisId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereHeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereMidName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person wherePagibigId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereSex($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereTinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Person whereWeight($value)
 */
	class Person extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Post
 *
 * @property int $id
 * @property int $post_category_id
 * @property int $user_id
 * @property int $active
 * @property string $title
 * @property string $content
 * @property string $cover
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\PostCategory|null $category
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Post newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Post query()
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCover($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post wherePostCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Post whereUserId($value)
 */
	class Post extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PostCategory
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PostCategory whereUserId($value)
 */
	class PostCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SalaryType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryType query()
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SalaryType whereUpdatedAt($value)
 */
	class SalaryType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Seminar
 *
 * @property int $id
 * @property int $info_id
 * @property string $name
 * @property string $from
 * @property string|null $to
 * @property string $hours
 * @property int $seminar_type_id
 * @property string $sponsor
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\SeminarType|null $seminar_type
 * @method static \Illuminate\Database\Eloquent\Builder|Seminar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Seminar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Seminar query()
 * @method static \Illuminate\Database\Eloquent\Builder|Seminar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seminar whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seminar whereHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seminar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seminar whereInfoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seminar whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seminar whereSeminarTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seminar whereSponsor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seminar whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Seminar whereUpdatedAt($value)
 */
	class Seminar extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SeminarType
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|SeminarType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SeminarType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SeminarType query()
 * @method static \Illuminate\Database\Eloquent\Builder|SeminarType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeminarType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeminarType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeminarType whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SeminarType whereUserId($value)
 */
	class SeminarType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Skill
 *
 * @property int $id
 * @property int $info_id
 * @property string $name
 * @property string|null $recognition
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Skill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Skill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Skill query()
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereInfoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereRecognition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Skill whereUpdatedAt($value)
 */
	class Skill extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string|null $email
 * @property string|null $password
 * @property string|null $avatar
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Info|null $info
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Voluntary
 *
 * @property int $id
 * @property int $info_id
 * @property string $name
 * @property string $from
 * @property string|null $to
 * @property string $hours
 * @property string $position
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntary query()
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntary whereFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntary whereHours($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntary whereInfoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntary whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntary wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntary whereTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voluntary whereUpdatedAt($value)
 */
	class Voluntary extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\WorkStatus
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|WorkStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder|WorkStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkStatus whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WorkStatus whereUserId($value)
 */
	class WorkStatus extends \Eloquent {}
}

