import { StudentEffects } from './store/student.effects';
import { StudentService } from './student.service';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { NgModule } from '@angular/core';

import { StudentsComponent } from './component/students.component';
import { StoreModule } from '@ngrx/store';
import { EffectsModule } from '@ngrx/effects';
import { studentReducer } from './store/student.reducers';
// import { CreateStudentComponent } from './component/create-student/create-student.component';

@NgModule({
  declarations: [
    StudentsComponent,
    // CreateStudentComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
    StoreModule.forFeature('students', studentReducer),
    EffectsModule.forFeature([StudentEffects])
  ],
  providers: [StudentService],
  bootstrap: [],
  exports: [
    StudentsComponent,
    // CreateStudentComponent
  ]
})
export class StudentModule { }
