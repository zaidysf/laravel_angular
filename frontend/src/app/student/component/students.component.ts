import { getAllStudents } from '../store/student.selectors';
import { studentActionTypes } from '../store/student.actions';
import { State } from '../../store/reducers/index';
import { Store } from '@ngrx/store';
import { Observable } from 'rxjs';
import { Student } from '../student.model';
import { StudentService } from '../student.service';
import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators, NgForm } from '@angular/forms';
import { Update } from '@ngrx/entity';

@Component({
  selector: 'app-students',
  templateUrl: './students.component.html'
})
export class StudentsComponent implements OnInit {

  students$!: Observable<Student[]>;

  displayedColumns: string[] = ['id', 'name'];

  studentToBeUpdated!: Student;

  isUpdateActivated = false;

  constructor(private studentService: StudentService, private store: Store<State>) { }

  ngOnInit() {
    this.students$ = this.store.select(getAllStudents);
  }

  deleteStudent(studentId: number) {
    this.store.dispatch(studentActionTypes.deleteStudent({studentId}));
  }

  showUpdateForm(student: Student) {
    this.studentToBeUpdated = {...student};
    this.isUpdateActivated = true;
  }

  updateStudent(updateForm: { value: any; }) {
    const update: Update<Student> = {
      id: this.studentToBeUpdated.id,
      changes: {
        ...this.studentToBeUpdated,
        ...updateForm.value
      }
    };

    this.store.dispatch(studentActionTypes.updateStudent({update}));

    this.isUpdateActivated = false;
    this.studentToBeUpdated = {id: 0, name: ''};
  }
}
