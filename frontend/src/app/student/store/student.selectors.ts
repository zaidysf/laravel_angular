import { StudentState } from './student.reducers';
import { Student } from '../student.model';
import { createSelector, createFeatureSelector } from '@ngrx/store';
import { selectAll, selectIds } from './student.reducers';

export const studentFeatureSelector = createFeatureSelector<StudentState>('students');

export const getAllStudents = createSelector(
  studentFeatureSelector,
  selectAll
);

export const areStudentsLoaded = createSelector(
  studentFeatureSelector,
  state => state.studentsLoaded
);
