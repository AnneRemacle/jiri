import React, { Component } from 'react';
import { Link } from 'react-router';
import { connect } from 'react-redux';
import { history } from '../store';

import * as userActions from '../actions/user';
import * as eventActions from '../actions/event';
import * as studentActions from '../actions/student';

const mapStateToProps = state => ({
    allStudents: state.studentSelectors.students,
    user: state.userSelectors.user,
    event: state.eventSelectors.event,
    student: state.studentSelectors.student
});

const mapActionsToProps = dispatch => ({
    getStudents(){
        dispatch(studentActions.getStudents())
    },
    getStudent(student_id){
        dispatch(studentActions.getStudent(student_id))
    },
    getUser(token){
        dispatch(userActions.getUser(token))
    },
    getEvent(event_id){
        dispatch(eventActions.getEvent(event_id));
    },
    updateStudent(formData, student_id){
        dispatch(studentActions.updateStudent(formData, student_id))
    }
})

@connect(mapStateToProps, mapActionsToProps)
export default class EditStudent extends Component {
    constructor(oProps) {
        super(oProps);

        this.state= {
            name: this.props.student && this.props.student.name,
            email: this.props.student && this.props.student.email,
            photo: this.props.student && this.props.student.photo
        }
    }

    componentWillMount(){
        this.props.getStudent(this.props.params.id);
        this.props.getStudents();

        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }

        if(!sessionStorage.getItem("token") && !this.props.user){
            history.push("/login");
        }
    }

    componentWillReceiveProps(oNextProps){
        if(oNextProps.student && oNextProps.student != this.props.student){
            this.setState({
                name: oNextProps.student.name,
                email: oNextProps.student.email,
                photo: oNextProps.student.photo
            })
        }
    }

    handleSubmit(e) {
        e.preventDefault();

        var formData = new FormData();

        if(this.state.file){
            var imagedata = e.target.querySelector("#photo").files[0];
            formData.append("picture", imagedata);
        }

        formData.append("name", this.state.name);
        formData.append("email", this.state.email);
        formData.append("event_id", this.props.event.id);

        this.props.updateStudent( formData, this.props.params.id );
    }

    handleStudentNameChange(e) {
        this.setState({
            name: e.target.value
        })
    }

    handleStudentEmailChange(e) {
        this.setState({
            email: e.target.value
        })
    }

    handlePictureChange(e){
        let reader = new FileReader();
        let file = e.target.files[0];

        reader.onloadend = () => {
          this.setState({
            file: file,
            imagePreviewUrl: reader.result,
          });
        }

        reader.readAsDataURL(file)
    }

    renderFigure(){
        if (this.props.student.photo === "") {
            return (<figure className="edit-avatar__figure">
                <img src={ this.state.imagePreviewUrl ? this.state.imagePreviewUrl : "https://placeimg.com/200/200/people/grayscale"} className="edit-avatar__img" />
            </figure>);
        }
        return (
            <figure className="edit-avatar__figure">
                <img src={ this.state.imagePreviewUrl ? this.state.imagePreviewUrl :  `http://localhost:8000/img/students/${this.props.student.photo}`} className="edit-avatar__img" />
            </figure>
        )
    }

    render() {
        if (!this.props.event) {
            return(
                <p>Chargement</p>
            );
        }

        return(
            <section className="main">
                <Link  to={ `event/${this.props.params.id}/manageStudents` } className="back">Retour à l'événement</Link>

                <h2 className="section__title">Modifier l'étudiant</h2>

                <form className="form form-regular" onSubmit={ this.handleSubmit.bind(this) } encType="multipart/form-data">
                    <div className="form-group">
                        <label htmlFor="email" className="form__label">Email</label>
                        <input list="students" type="email" name="email" id="email" placeholder="jon@snow.be" className="form__input" onChange={this.handleStudentEmailChange.bind(this)} value={this.state.email}/>
                        <datalist id='students'>
                            {
                                this.props.allStudents
                                ? this.props.allStudents.map( student => <option key={student.id} value={student.email} />)
                                : ""
                            }
                        </datalist>
                    </div>
                    <div className="form-group">
                        <label htmlFor="name" className="form__label">Nom</label>
                        <input type="text" id='name' name="name" placeholder="Jon Snow" className="form__input" onChange={this.handleStudentNameChange.bind(this)} value={this.state.name}/>
                    </div>
                    <div className="form-group">
                        <label className="form__label form__label--file" htmlFor="photo">
                            <section className="edit-avatar">
                                {this.renderFigure()}
                            </section>
                        </label>
                        <input className="hidden" type="file" name="photo" id="photo" value="" onChange={ this.handlePictureChange.bind(this) }/>
                    </div>
                    <div className="form-group">
                        <input type="submit" className="form__button" value='Modifier'/>
                    </div>
                </form>
            </section>
        );
    }
}
