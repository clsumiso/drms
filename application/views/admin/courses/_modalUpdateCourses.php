    <div class="modal" id="modalUpdateCourses">
        <div class="modal-wrapper-colleges">
            
            <h3 class="modal-custom-title"><i class="fas fa-plus-circle me-2"></i>update new course</h3>
            
            <hr>

            <form action="" id="formUpdateCourse">

                <input type="text" class="d-none" id="setCourseID" name="setCourseID">

                <div class="form-group mb-3">
                    <select name="u_getCourseCollege" id="u_getCourseCollege" class="form-select">
                        <option value="0">-- Select college --</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <input type="text" id="u_getCourse" name="u_getCourse" class="form-control" placeholder="Course Name">
                </div>

                <div class="form-group mb-3">
                    <input type="text" id="u_getCourseAcronym" name="u_getCourseAcronym" class="form-control" placeholder="Course Acronym">
                </div>

                <hr>
                
                <div class="button-form-wrapper">
                    <button class="btn btn-default border" type="button" id="modalUpdateCoursesClose">Discard</button>
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>

        </div>
    </div>