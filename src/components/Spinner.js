import React, {Component} from 'react';

export default class Spinner extends Component {
    constructor(oProps) {
        super(oProps);
    }
    render() {
        return (
            <div className="spinner">
                <i className="fas fa-spinner fa-pulse fa-3x fa-fw"></i>
                <span className="spinner__text">{this.props.message}</span>
            </div>
        );
    }
}
