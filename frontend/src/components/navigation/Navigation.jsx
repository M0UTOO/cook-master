import { Link } from 'react-router-dom'

import { routes } from '@/router/routes'

import styles from './Navigation.module.scss'

export const Navigation = ({containerClassname, itemsClassname}) => {
        
    return (
        <div className={containerClassname}>
            {routes[0].children.map((route, index) => {
                if(route.displayedName === undefined) {
                    return
                }

                return (
                    <div className={itemsClassname} key={index}>
                        <Link
                            
                            to={route.path || '/'}
                        >
                            {route.displayedName}
                        </Link>
                    </div>
                )
            })}
        </div>
    )
}
