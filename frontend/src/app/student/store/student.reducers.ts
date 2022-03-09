import { Student } from '../student.model';
import { EntityState, EntityAdapter, createEntityAdapter } from '@ngrx/entity';
import { createReducer, on } from '@ngrx/store';
import { studentActionTypes, studentsLoaded } from './student.actions';

export interface StudentState extends EntityState<Student> {
  studentsLoaded: boolean;
}

export const adapter: EntityAdapter<Student> = createEntityAdapter<Student>();

export const initialState = adapter.getInitialState({
  studentsLoaded: false
});

export const studentReducer = createReducer(
  initialState,

  on(studentActionTypes.studentsLoaded, (state, action) => {
    return adapter.setAll(
      action.students,
      {...state, studentsLoaded: true}
    );
  }),

  on(studentActionTypes.createStudent, (state, action) => {
    return adapter.addOne(action.student, state);
  }),

  on(studentActionTypes.deleteStudent, (state, action) => {
    return adapter.removeOne(action.studentId, state);
  }),

  on(studentActionTypes.updateStudent, (state, action) => {
    return adapter.updateOne(action.update, state);
  })
);

export const { selectAll, selectIds } = adapter.getSelectors();
