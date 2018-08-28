import React, { Component } from 'react';
import { Link } from 'react-router';
import { connect } from 'react-redux';

import Spinner from "./Spinner";

import * as userActions from '../actions/user';
import * as eventActions from '../actions/event';
import * as studentActions from '../actions/student';

const mapStateToProps = state => ({
    user: state.userSelectors.user,
    event: state.eventSelectors.event,
    eventStudents: state.eventSelectors.students,
    allStudents: state.studentSelectors.students,
    student: state.eventSelectors.student,
    studentAddOrStorePending: state.studentSelectors.addOrStorePending
});

const mapActionsToProps = dispatch => ({
    getStudents(){
        dispatch(studentActions.getStudents())
    },
    getUser(token){
        dispatch(userActions.getUser(token))
    },
    getEvent(event_id){
        dispatch(eventActions.getEvent(event_id));
    },
    getEventStudents(event_id){
        dispatch(eventActions.getEventStudents(event_id))
    },
    addOrStoreStudent(formData){
        dispatch(studentActions.addOrStore(formData))
    },
    removeStudent(event_id, student_id){
        dispatch(eventActions.removeStudent(event_id, student_id))
    }
})

@connect(mapStateToProps, mapActionsToProps)
export default class AddStudent extends Component {
    constructor(oProps) {
        super(oProps);

        this.state= {
            name: "",
            email: "",
            photo: null,
            values: {
                newPicture: ""
            },
            errors: {
                picture: []
            }
        }
    }

    componentWillMount(){
        this.props.getStudents();
        this.props.getEvent(this.props.params.id);
        this.props.getEventStudents(this.props.params.id);

        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }

        if(!sessionStorage.getItem("token") && !this.props.user){
            history.push("/login");
        }
    }

    componentWillReceiveProps(oNextProps){
        if(!oNextProps.studentAddOrStorePending && oNextProps.studentAddOrStorePending != this.props.studentAddOrStorePending){
            this.setState({
                name: "",
                email: "",
                file: null,
                imagePreviewUrl: null,
            })

            document.querySelector("#photo").value = null;
        }
    }

    handleSubmit(e) {
        e.preventDefault();
        var formData = new FormData();

        if(this.state.file) {
            var imagedata = e.target.querySelector("#photo").files[0];
            formData.append("picture", imagedata);
        }

        formData.append("name", this.state.name);
        formData.append("email", this.state.email);
        formData.append("event_id", this.props.event.id);

        this.props.addOrStoreStudent( formData );
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

    handleDeleteClick(e) {
        e.preventDefault();
        console.warn(this.props.event.id, parseFloat(e.target.dataset.student));
        this.props.removeStudent( this.props.event.id, parseFloat(e.target.dataset.student) );
    }

    renderFigure(){
        return (
            <figure className="edit-avatar__figure">
                <img src={ this.state.imagePreviewUrl ? this.state.imagePreviewUrl : "https://placeimg.com/200/200/people/grayscale"} className="edit-avatar__img" />
            </figure>
        )
    }

    render() {
        if (!this.props.event) {
            return (
                <div className="regular-spinner">
                    <Spinner message={'Chargement'} />
                </div>
            );
        }

        return(
            <section className="section">
                <Link  to={ `showEvent/${this.props.params.id}` } className="back"><i className="fa fa-caret-left"></i>Retour à l'événement</Link>

                <h2 className="section__title">Ajouter un étudiant à {this.props.event.course_name}</h2>
                <p>Ajoutez un étudiant qui participera à l'examen.</p>

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
                        <input type="text" id='name' name="name" placeholder="Jon Snow" className="form__input" onChange={this.handleStudentNameChange.bind(this)} value={this.state.name} />
                    </div>
                    <div className="form-group">
                        <label className="form__label form__label--file" htmlFor="photo">
                            <section className="edit-avatar">
                                {this.renderFigure()}
                            </section>
                        </label>
                        <input className="hidden" type="file" name="photo" id="photo" onChange={ this.handlePictureChange.bind(this) }/>
                    </div>
                    <div className="form-group">
                        <input type="submit" className="form__button button" value='Ajouter'/>
                    </div>
                </form>
                <section className="sub-section">
                    <h3 className="sub-section__title">Étudiant(s) ajoutés à {this.props.event.course_name}</h3>
                    {
                        this.props.eventStudents
                        ? this.props.eventStudents.map( student =>
                            <div className="item" key={student.id}>
                                <span className="item__name">{student.name}</span>
                                <Link to={`event/${this.props.event.id}/manageStudent/${student.id}`}>Encoder les urls</Link>
                                <Link className="buttons edit-button" to={`student/${student.id}/edit`} title={`modifier la fiche de ${student.name}`}>
                                <i className="fa fa-pencil"></i></Link>
                                <a className="buttons delete-button" href="#" onClick={this.handleDeleteClick.bind(this)} data-student={student.id} title={`supprimer ${student.name} de l’événement`}><i data-student={student.id} className="fa fa-trash"></i></a>
                            </div>
                        )
                        : <p>Il n'y a pas encore d'étudiants pour cet événement</p>
                    }
                </section>
            </section>
        );
    }
}
