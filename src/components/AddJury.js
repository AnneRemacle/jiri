import React, { Component } from 'react';
import { Link } from 'react-router';
import { connect } from 'react-redux';

import * as userActions from '../actions/user';
import * as eventActions from '../actions/event';
import * as studentActions from '../actions/student';

const mapStateToProps = state => ({
    user: state.userSelectors.user,
    event: state.eventSelectors.event,
    allJurys: state.userSelectors.jurys,
    eventJurys: state.eventSelectors.jurys,
    jury: state.eventSelectors.jury,
    userAddOrStorePending: state.userSelectors.addOrStorePending
});

const mapActionsToProps = dispatch => ({
    getUser(token){
        dispatch(userActions.getUser(token))
    },
    getEvent(event_id){
        dispatch(eventActions.getEvent(event_id));
    },
    getJurys() {
        dispatch(userActions.getJurys());
    },
    getEventJurys(event_id){
        dispatch(eventActions.getEventJurys(event_id))
    },
    addOrStoreJury(formData){
        dispatch(userActions.addOrStore(formData))
    },
    getJury(user_id){
        dispatch(userActions.getJury(user_id))
    },
    removeJury(event_id, user_id){
        dispatch(eventActions.removeJury(event_id, user_id))
    }
})

@connect(mapStateToProps, mapActionsToProps)
export default class AddJury extends Component {
    constructor(oProps) {
        super(oProps);

        this.state= {
            name: "",
            email: "",
            company:'',
            password: '',
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
        this.props.getJurys();
        this.props.getEvent(this.props.params.id);
        this.props.getEventJurys(this.props.params.id);

        if(sessionStorage.getItem("token") && !this.props.user){
            this.props.getUser(sessionStorage.getItem("token"));
        }

        if(!sessionStorage.getItem("token") && !this.props.user){
            history.push("/login");
        }
    }

    componentWillReceiveProps(oNextProps){
        if(!oNextProps.userAddOrStorePending && oNextProps.userAddOrStorePending != this.props.userAddOrStorePending){
            this.setState({
                name: "",
                email: "",
                company: "",
                password: "",
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
        formData.append("password", this.state.password);
        formData.append("event_id", this.props.event.id);

        this.props.addOrStoreJury( formData );
    }

    handleJuryNameChange(e) {
        this.setState({
            name: e.target.value
        })
    }

    handleJuryEmailChange(e) {
        this.setState({
            email: e.target.value
        })
    }

    handleJuryCompanyChange(e) {
        this.setState({
            company: e.target.value
        })
    }

    handleJuryPasswordChange(e) {
        this.setState({
            password: e.target.value
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
        this.props.removeJury( this.props.event.id, parseFloat(e.target.dataset.jury) );
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
            return(
                <p>Chargement</p>
            );
        }

        return(
            <section className="main">
                <Link  to={ `showEvent/${this.props.params.id}` } className="back">Retour à l'événement</Link>

                <h2 className="section__title">Ajouter un jury à {this.props.event.course_name}</h2>

                <form className="form form-regular" onSubmit={ this.handleSubmit.bind(this) } encType="multipart/form-data">
                    <div className="form-group">
                        <label htmlFor="email" className="form__label">Email</label>
                        <input value={this.state.email} list="students" type="email" name="email" id="email" placeholder="jon@snow.be" className="form__input" onChange={this.handleJuryEmailChange.bind(this)}/>
                        <datalist id='students'>
                            {
                                this.props.allJurys
                                ? this.props.allJurys.map( jury => <option key={jury.id} value={jury.email} />)
                                : ""
                            }
                        </datalist>
                    </div>
                    <div className="form-group">
                        <label htmlFor="name" className="form__label">Nom</label>
                        <input value={this.state.name} type="text" id='name' name="name" placeholder="Jon Snow" className="form__input" onChange={this.handleJuryNameChange.bind(this)} />
                    </div>
                    <div className="form-group">
                        <label htmlFor="company" className="form__label">Entreprise</label>
                        <input value={this.state.company} type="text" id='company' name="company" placeholder="Google" className="form__input" onChange={this.handleJuryCompanyChange.bind(this)} />
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
                        <label htmlFor="password" className="form__label">Mot de passe</label>
                        <input value={this.state.password} type="text" id='password' name="password" className="form__input" onChange={this.handleJuryPasswordChange.bind(this)} />
                    </div>
                    <div className="form-group">
                        <input type="submit" className="form__button" value='Ajouter'/>
                    </div>
                </form>
                <section className="sub-section">
                    <h3>Jury(s) ajoutés à {this.props.event.course_name}</h3>
                    <ul>
                        {
                            this.props.eventJurys
                            ? this.props.eventJurys.map( jury =>
                                <li key={jury.id}>
                                    {jury.name}
                                    <Link to={`jury/${jury.id}/edit`}>Modifier</Link> - <a href="#" onClick={this.handleDeleteClick.bind(this)} data-jury={jury.id}>Supprimer</a>
                                </li>
                            )
                            : <p>Il n'y a pas encore de jurys pour cet événement</p>
                        }
                    </ul>
                </section>
            </section>
        );
    }
}
