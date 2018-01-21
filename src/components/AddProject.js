import React, { Component } from 'react';
import { Link } from 'react-router';
import { connect } from 'react-redux';

import * as projectActions from '../actions/project';
import * as userActions from '../actions/user';
import * as eventActions from '../actions/event';

const mapStateToProps = state => ({
    allProjects: state.projectSelectors.projects,
    projectError: state.projectSelectors.error,
    user: state.userSelectors.user,
    event: state.eventSelectors.event,
    eventProjects: state.eventSelectors.projects,
    project: state.eventSelectors.project
});

const mapActionsToProps = dispatch => ({
    getProjects(){
        dispatch(projectActions.getProjects())
    },
    getUser(token){
        dispatch(userActions.getUser(token))
    },
    getEvent(event_id){
        dispatch(eventActions.getEvent(event_id));
    },
    getEventProjects(event_id){
        dispatch(eventActions.getEventProjects(event_id))
    },
    addOrStoreProject(name, description, event_id, user_id){
        dispatch(projectActions.addOrStore(name, description, event_id, user_id))
    },
    removeProject( event_id, project_id ) {
        dispatch(eventActions.removeProject(event_id, project_id))
    }
})

@connect(mapStateToProps, mapActionsToProps)
export default class AddProject extends Component {
    constructor(oProps) {
        super(oProps);

        this.state= {
            name: "",
            description: ""
        }
    }

    componentWillMount(){
        this.props.getProjects();
        this.props.getEvent(this.props.params.id);
        this.props.getEventProjects(this.props.params.id);

        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }

        if(!sessionStorage.getItem("token") && !this.props.user){
            history.push("/login");
        }
    }

    handleSubmit(e) {
        e.preventDefault();
        this.props.addOrStoreProject(this.state.name, this.state.description, this.props.event.id, this.props.user.id);
    }

    handleProjectNameChange(e) {
        this.setState({
            name: e.target.value
        })
    }

    handleDescriptionChange(e) {
        this.setState({
            description: e.target.value
        })
    }

    handleDeleteClick(e) {
        e.preventDefault();
        this.props.removeProject( this.props.event.id, e.target.dataset.project )
    }

    render() {
        return(
            <section className="main">
                <Link className="back">Retour au dashboard</Link>

                <h2 className="section__title">Ajouter un projet</h2>

                <form className="form form-regular" onSubmit={this.handleSubmit.bind(this)}>
                    <div className="form-group">
                        <label htmlFor="name" className="form__label">Nom du projet</label>
                        <input list="projects" type="text" name="name" id="name" placeholder="CV à la manière de…" className="form__input" onChange={this.handleProjectNameChange.bind(this)}/>
                        <datalist id='projects'>
                            {
                                this.props.allProjects
                                ? this.props.allProjects.map( project => <option key={project.id} value={project.name} />)
                                : ""
                            }
                        </datalist>
                    </div>
                    <div className="form-group">
                        <label htmlFor="description" className="form__label">Description</label>
                        <textarea name="description" id="description" className="form__select" onChange={this.handleDescriptionChange.bind(this)}>
                        </textarea>
                    </div>
                    <div className="form-group">
                        <input type="submit" className="form__button" value='Ajouter'/>
                    </div>
                </form>
                <h3>Projet(s) de l'évènement</h3>
                <ul>
                    {
                        this.props.eventProjects
                        ? this.props.eventProjects.map( project =>
                            <li key={project.id}>
                                {project.name}
                                <Link to={`project/${project.id}/edit`}>Modifier</Link> - <a href="#" onClick={this.handleDeleteClick.bind(this)} data-project={project.id}>Supprimer</a>
                            </li>
                        )
                        : <p>Il n'y a pas encore de projets pour cet événement</p>
                    }
                </ul>
            </section>
        );
    }
}
