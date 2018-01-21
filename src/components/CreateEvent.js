import React, { Component } from 'react';
import { Link } from 'react-router';
import moment from 'moment';
import { connect } from 'react-redux';
import { history } from '../store';

import * as eventActions from '../actions/event';

const mapStateToProps = state => ({
    user: state.userSelectors.user,
})

const mapActionsToProps = dispatch => ({
    createEvent( name, academic_year, session, user_id ) {
        dispatch( eventActions.createEvent(name, academic_year, session, user_id) );
    }
})

@connect(mapStateToProps, mapActionsToProps)
export default class CreateEvent extends Component {
    constructor(oProps){
        super(oProps);

        this.state = {
            courseName: "Cours",
            academicYear: `${moment().format("Y")-1} - ${moment().format("Y")}`,
            session: 1
        }
    }
    handleSubmit(e) {
        e.preventDefault();
        this.props.createEvent( this.state.courseName, this.state.academicYear, this.state.session, this.props.user.id );
        history.push('/');
    }

    renderOptions() {
        let yearsLabel = [];

        for(let i = moment().format("Y"); i <  moment().add(10, 'Y').format("Y"); i++){
            yearsLabel.push((<option key={`${i-1} - ${i}`} value={`${i-1} - ${i}`}>{`${i-1} - ${i}`}</option>));
        }

        return yearsLabel;
    }

    handleCourseNameChange(e){
        this.setState({
            courseName: e.target.value
        })
    }

    handleAcademicYearChange(e){
        this.setState({
            academicYear: e.target.value
        })
    }

    handleSessionChange(e){
        this.setState({
            session: e.target.value
        })
    }

    render() {
        return(
            <section className="main">
                <Link to='/' className="back">Retour au dashboard</Link>
                <h2 className="section__title">Créer un événement</h2>

                <form className="form form-regular" onSubmit={this.handleSubmit.bind(this)}>
                    <div className="form-group">
                        <label htmlFor="course_name" className="form__label">Nom du cours</label>
                        <input type="text" name="course_name" id="course_name" placeholder="Design Web" className="form__input" onChange={this.handleCourseNameChange.bind(this)}/>
                    </div>
                    <div className="form-group">
                        <label htmlFor="academic_year" className="form__label">Année académique</label>
                        <select name="academic_year" id="academic_year" className="form__select" onChange={this.handleAcademicYearChange.bind(this)}>
                            {this.renderOptions()}
                        </select>
                    </div>
                    <div className="form-group">
                        <label htmlFor="session" className="form__label">Session</label>
                        <select name="session" id="session" className="form__select" onChange={this.handleSessionChange.bind(this)}>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    <div className="form-group">
                        <input type="submit" className="form__button" value='Créer un événement'/>
                    </div>
                </form>
            </section>
        );
    }
}
