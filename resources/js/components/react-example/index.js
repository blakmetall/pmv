import React from 'react';
import ReactDOM from 'react-dom';

function ReactExample() {
    return (
        <div className="container app-container">
            <div className="row">
                <div className="col-md-8">
                    <div className="card">
                        <div className="card-header">React Example Component</div>

                        <div className="card-body">I'm a React example component!</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default ReactExample;

if (document.getElementById('react-example')) {
    ReactDOM.render(<ReactExample />, document.getElementById('react-example'));
}
