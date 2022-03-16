    <div class="modal" id="modalCreateCourses">
        <div class="modal-wrapper-colleges">
            
            <h3 class="modal-custom-title"><i class="fas fa-plus-circle me-2"></i>Create new course</h3>
            
            <hr>

            <form action="" id="formCreateCourse">
                <div class="form-group mb-3">
                    <select name="c_getCourseCollege" id="c_getCourseCollege" class="form-select">
                        <option value="0" selected>-- Select college --</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <input type="text" id="c_getCourse" name="c_getCourse" class="form-control" placeholder="Course Name" autocomplete="off">
                </div>

                <div class="form-group mb-3">
                    <input type="text" id="c_getCourseAcronym" name="c_getCourseAcronym" class="form-control" placeholder="Course Acronym" autocomplete="off">
                </div>

                <hr>
                
                <div class="button-form-wrapper">
                    <button class="btn btn-default border" type="button" id="btnAddCoursesClose">Discard</button>
                    <button class="btn btn-success" type="submit">Create</button>
                </div>
            </form>

        </div>
    </div>