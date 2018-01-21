import React, { Component } from 'react';
import { Link } from 'react-router';
import moment from 'moment';
import { connect } from 'react-redux';
import { history } from '../store';

import * as eventActions from '../actions/event';
import * as userActions from '../actions/user';

const mapStateToProps = state => ({
    user: state.userSelectors.user,
    event: state.eventSelectors.event,
});

const mapActionsToProps = dispatch => ({
    updateEvent( course_name, academic_year, exam_session, event_id, user_id ) {
        dispatch( eventActions.updateEvent( course_name, academic_year, exam_session, event_id, user_id ) );
    },
    getUser(token){
        dispatch( userActions.getUser(token) )
    },
    getEvent(event_id){
        dispatch( eventActions.getEvent(event_id))
    }
});

@connect(mapStateToProps, mapActionsToProps)
export default class EditEvent extends Component {
    constructor(oProps){
        super(oProps);
        this.state = {
            course_name: this.props.event && this.props.event.course_name,
            academic_year: this.props.event && this.props.event.academic_year,
            exam_session: this.props.event && this.props.event.exam_session
        }
    }

    componentWillMount(){
        this.props.getEvent(this.props.params.id);

        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }

        if(!sessionStorage.getItem("token") && !this.props.user){
            history.push("/login");
        }
    }

    componentWillReceiveProps(oNextProps){
        if(oNextProps.event && oNextProps.event != this.props.event){
            this.setState({
                course_name: oNextProps.event.course_name,
                academic_year: oNextProps.event.academic_year,
                exam_session: oNextProps.event.exam_session
            })
        }
    }

    handleSubmit(e) {
        e.preventDefault();
        this.props.updateEvent( this.state.course_name, this.state.academic_year, this.state.exam_session, this.props.event.id, this.props.user.id );
        history.push('/my/events');
    }

    renderOptions() {
        let yearsLabel = [];

        for(let i = moment().format("Y"); i <  moment().add(10, 'Y').format("Y"); i++){
            yearsLabel.push(
                (
                    <option
                        key={`${i-1} - ${i}`}
                        value={`${i-1} - ${i}`}
                    >
                        {`${i-1} - ${i}`}
                    </option>)
                );
        }

        return yearsLabel;
    }

    handleCourseNameChange(e){
        this.setState({
            course_name: e.target.value
        })
    }

    handleAcademicYearChange(e){
        this.setState({
            academic_year: e.target.value
        })
    }

    handleSessionChange(e){
        this.setState({
            exam_session: e.target.value
        })
    }

    render() {
        if(!this.props.event){
            return <p>{"Chargement..."}</p>
        }

        return(
            <section className="main">
                <Link to='/' className="back">Retour au dashboard</Link>
                <h2 className="section__title">Créer un événement</h2>

                <form className="form form-regular" onSubmit={this.handleSubmit.bind(this)}>
                    <div className="form-group">
                        <label htmlFor="course_name" className="form__label">Nom du cours</label>
                        <input value={this.state.course_name} type="text" name="course_name" id="course_name" placeholder="Design Web" className="form__input" onChange={this.handleCourseNameChange.bind(this)}/>
                    </div>
                    <div className="form-group">
                        <label htmlFor="academic_year" className="form__label">Année académique</label>
                        <select defaultValue={this.state.academic_year} name="academic_year" id="academic_year" className="form__select" onChange={this.handleAcademicYearChange.bind(this)}>
                            {this.renderOptions()}
                        </select>
                    </div>
                    <div className="form-group">
                        <label htmlFor="session" className="form__label">Session</label>
                        <select defaultValue={this.state.exam_session} name="session" id="session" className="form__select" onChange={this.handleSessionChange.bind(this)}>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div className="form-group">
                        <input type="submit" className="form__button" value='Modifier cet événement'/>
                    </div>
                </form>
            </section>
        );
    }
}
