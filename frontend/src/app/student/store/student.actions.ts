import { Student } from '../student.model';
import { createAction, props } from '@ngrx/store';
import {Update} from '@ngrx/entity';


export const loadStudents = createAction(
  '[Students List] Load Students via Service',
);

export const studentsLoaded = createAction(
  '[Students Effect] Students Loaded Successfully',
  props<{students: Student[]}>()
);

export const createStudent = createAction(
  '[Create Student Component] Create Student',
  props<{student: Student}>()
);

export const deleteStudent = createAction(
  '[Students List Operations] Delete Student',
  props<{studentId: number}>()
);

export const updateStudent = createAction(
  '[Students List Operations] Update Student',
  props<{update: Update<Student>}>()
);

export const studentActionTypes = {
  loadStudents,
  studentsLoaded,
  createStudent,
  deleteStudent,
  updateStudent
};
